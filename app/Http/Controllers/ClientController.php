<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helpers;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use App\Models\Product;
use App\Models\Service;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Billing\NOWPaymentsController;
use App\Http\Controllers\Orders\OrderController;
use App\Http\Controllers\Billing\PaymentController;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ClientController extends Controller
{

	/**
	 * Initialize ClientController
	 *
	 * @author Motify
	 */
    public function __construct()
	{

	}


	/**
	 * Obtain user data for front-end
	 *
	 * @return array
	 */
    public static function getUserData()
	{
		$data = [
			'guest'	=> true,
			'id' =>	NULL,
			'username' => NULL,
			'email' => NULL,
			'created_at' => NULL,
			'balance' => 0.00,
			'roles' => [],
			'permissions' => []
		];

		$user = request()->user();

		if (!\is_null($user)) {
			$data['guest'] = false;
			$data['id'] = $user['id'];
			$data['username'] = $user['username'];
			$data['email'] = $user['email'];
			$data['created_at'] = $user['created_at']->setTimezone(new \DateTimeZone('UTC'))->getTimestamp();
			$data['balance'] = \floatval( $user['balance'] );
			$data['roles'] = $user->roles->pluck('name')->toArray();
			$data['permissions'] = $user->getPermissionsViaRoles()->pluck('name')->toArray();
		}

		return $data;
	}


	/**
	 * Get user balance by ID
	 *
	 * @author Motify
	 * @param  mixed $id
	 * @return float
	 */
	public function getUserBalance($id) : float
	{
		$balance = 0;

		$user = User::select('balance')->where(['id' => $id])->get()->toArray();
		
		if (0 === \count($user)) {
			return $balance;
		}

		$balance = \floatval( $user[0]['balance'] );

		return $balance;
	}

	
	/**
	 * Set user balance by ID
	 *
	 * @author Motify
	 * @param  mixed $id
	 * @param  float $balance
	 * @return void
	 */
	public function setUserBalance($id, float $balance)
	{
		$user = User::select('balance')->where(['id' => $id])->first();

		if (\is_null($user)) {
			return;
		}
		
		User::where(['id' => $id])->update(['balance' => $balance]);
	}


	/**
	 * Display the clientarea index view
	 *
	 * @param  Request $request
	 * @return void
	 */
	public function showIndex(Request $request)
	{
		$services = Service::select('id')->where(['user_id' => auth()->id(), 'status' => 1])->get()->count();
		$invoices = Payment::select('token')->where(['user_id' => auth()->id(), 'status' => 0])->get()->count();
		
		
		return Inertia::render('Clientarea/Index', [
			'statistics'	=>	[
				'invoices'	=>	$invoices,
				'services'	=>	$services
			]
		]);
	}


	/**
	 * Display the clientarea invoices view
	 *
	 * @return void
	 */
	public function showInvoices()
	{

		$invoices = Payment::select('token', 'invoice_id', 'amount', 'status', 'created_at', 'updated_at')->where('user_id', auth()->id())->orderByDesc('created_at')->paginate(15);
		$items = $invoices->through(function ($invoice) {
			$paymentController = new PaymentController();
			return [
				'token' => $invoice->token,
				'invoice_id' => $invoice->invoice_id,
				'amount' => $invoice->amount,
				'status' => $paymentController->getPaymentStatusLabel($invoice->status),
				'created_at' => $invoice->created_at,
				'updated_at' => $invoice->updated_at
			];
		});

		return Inertia::render('Clientarea/Invoices', [
			'items'	=>	$items
		]);
	}


	/**
	 * Undocumented function
	 *
	 * @param  Request $request
	 * @param  string  $id
	 * @return array
	 */
	public function showInvoice(Request $request, string $id)
	{
		$invoice = Payment::select('token', 'invoice_id', 'amount', 'status', 'currency', 'address', 'amount_crypto', 'created_at', 'updated_at')
			->where([
				'user_id' => auth()->id(),
				'token' => $id
			])
			->first();

		$data = [
			'ok'	=>	false,
			'data'	=>	[
				'token' => NULL,
				'invoice_id' => NULL,
				'status' => [
					'id' => NULL,
					'text' => NULL
				],
				'amount' => [
					'fiat' => NULL,
					'crypto' => NULL,					
				],
				'currency' => NULL,
				'address' => NULL,
				'created_at' => NULL,
				'updated_at' => NULL
			]
		];
		
		if ( !\is_null($invoice) )
		{
			$paymentController = new PaymentController();
			
			$data = [
				'ok'	=>	true,
				'data'	=>	[
					'token' => $invoice->token,
					'invoice_id' => $invoice->invoice_id,
					'status' => [
						'id' => \intval($invoice->status),
						'text' => $paymentController->getPaymentStatusLabel($invoice->status)
					],
					'amount' => [
						'fiat' => $invoice->amount,
						'crypto' => $invoice->amount_crypto,					
					],
					'currency' => $invoice->currency,
					'address' => $invoice->address,
					'created_at' => $invoice->created_at,
					'updated_at' => $invoice->updated_at,
				]
			];
		}

		return Inertia::render('Clientarea/Invoice', [
			'invoice' => $data
		]);
	}
	

	/**
	 * Display the clientarea services view
	 *
	 * @param  Request $request
	 * @return void
	 */
	public function showServices(Request $request)
	{
		$user_id = auth()->id();
		$services = Service::select('services.id', 'services.pid', 'services.status', 'services.is_server', 'products.title', 'products.category', 'services.billing_amount', 'services.billing_type', 'services.expires_at', 'services.bandwidth', 'services.bandwidth_used', 'services.server_hardware', 'services.created_at', 'services.updated_at')
			->leftJoin('products', function($join) {
				$join->on('services.pid', '=', 'products.id');
			})
			->where(['services.user_id' => $user_id])
			->orderByDesc('created_at')
			->paginate(15)
			->through(function ($service) {
				$is_server = ($service->is_server !== 0) ? true : false;

				$title = 'N/A';
				$hardware = NULL;

				if ($is_server)
				{
					if ( !\is_null($service->server_hardware))
					{
						$orderController = new OrderController();
						$hardware = $orderController->unserializeServerProps( $service->server_hardware );

						$title = \sprintf('RDP - %d cores, %d GB, %d GB SSD', $hardware['cores'], $hardware['memory'], $hardware['storage']);
					}
					else
						$title = 'RDP';
				}
				else
					$title = ( !\is_null( $service->title ) ) ? $service->title : 'N/A';

				
				return [
					'id'				=>	$service->id,
					'pid'				=>	$service->pid,
					'title'				=>	$title,
					'status'			=>	$service->status,
					'billing_amount'	=>	$service->billing_amount,
					'billing_type'		=>	$service->billing_type,
					'expires_at'		=>	(!\is_null( $service->expires_at )) ? \strtotime( $service->expires_at ) : NULL,
					'bandwidth'			=>	[
						'total'			=>	\floatval( $service->bandwidth ),
						'used'			=>	\floatval( $service->bandwidth_used )
					],
					'is_server'			=>	$is_server,
					'server'			=>	[
						'hardware'		=>	$hardware
					],
					'created_at'		=>	\strtotime( $service->created_at )
				];
			});


		return Inertia::render('Clientarea/Services/Index', [
			'services'	=>	$services
		]);
	}


	/**
	 * Display an invidual service view for client
	 *
	 * @author Motifys
	 * @param  Request $request
	 * @param  string  $id
	 * @return void
	 */
	public function showService(Request $request, string $id)
	{

		$user = $request->user();

		$service = Service::select('services.id', 'services.user_id', 'users.username', 'users.email', 'services.pid', 'services.status', 'services.is_server', 'products.title', 'products.description', 'products.category', 'services.billing_amount', 'services.billing_type', 'services.expires_at', 'services.bandwidth', 'services.bandwidth_used', 'services.server_hardware', 'services.data', 'services.created_at', 'services.updated_at')
			->leftJoin('products', function($join) {
				$join->on('services.pid', '=', 'products.id');
			})
			->leftJoin('users', function($join) {
				$join->on('services.user_id', '=', 'users.id');
			})
			->where(['services.id' => $id])
			->first();

		$data = NULL;

		if ( !\is_null( $service ) )
		{

			$service_uid = \intval( $service->user_id );
			$uid = auth()->id();

			if ($uid === $service_uid || $user->hasRole('Administrator'))
			{
				$is_server = ($service->is_server !== 0) ? true : false;

				$title = 'N/A';
				$hardware = NULL;

				if ($is_server)
				{
					if ( !\is_null($service->server_hardware))
					{
						$orderController = new OrderController();
						$hardware = $orderController->unserializeServerProps( $service->server_hardware );

						$title = \sprintf('RDP - %d cores, %d GB, %d GB SSD', $hardware['cores'], $hardware['memory'], $hardware['storage']);
					}
					else
						$title = 'RDP';
				}
				else
					$title = ( !\is_null( $service->title ) ) ? $service->title : 'N/A';

				$data = [
					'id'				=>	$service->id,
					'pid'				=>	$service->pid,
					'title'				=>	$title,
					'status'			=>	$service->status,
					'billing_amount'	=>	$service->billing_amount,
					'expires_at'		=>	(!\is_null( $service->expires_at )) ? \strtotime( $service->expires_at ) : NULL,
					'is_server'			=>	$is_server,
					'created_at'		=>	\strtotime( $service->created_at )
				];

				if ( !$is_server )
				{
					$data['billing_type'] = $service->billing_type;
					$data['description'] = (!\is_null($service->description)) ? \implode(', ', \explode("\n", $service->description)) : NULL;
					$data['pid'] = $service->pid;
					$data['bandwidth'] = [
						'total'			=>	\floatval( $service->bandwidth ),
						'used'			=>	\floatval( $service->bandwidth_used )
					];
				}
				else
				{
					$data['server'] = [
						'hardware'		=>	$hardware
					];
				}	
			}
		}

		return Inertia::render('Clientarea/Services/View', [
			'service'	=>	$data
		]);
	}


	/**
	 * Display the clientarea account settings view
	 *
	 * @return void
	 */
	public function showAccount()
	{
		return Inertia::render('Clientarea/Account');
	}


	/**
	 * Handle an incoming request for password update
	 *
	 * @param  Request $request
	 * @return void
	 */
	public function passwordUpdate(Request $request)
	{
		$password_rule = (app()->isProduction()) ? Password::min(8)->letters()->numbers() : Password::min(6);

		$validator = Validator::make(request()->all(), [
			'current_password' => ['required', 'string', 'current_password'],
            'password' => ['required', 'confirmed', $password_rule],
        ]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator->errors(), 'password');
        }

		$executed = RateLimiter::attempt(
			'password-update:' . auth()->id(),
			$perMinute = 1,
			function() use ($validator) {
				$validated = $validator->validated();

				$new_password = Hash::make($validated['password']);

				auth()->user()->update([
					'password' => $new_password
				]);
				
				return to_route('clientarea.account');
			}
		);

		if (!$executed) {
			return redirect()->back()->withErrors([
				'password'	=>	'You’ve reached the rate limit for this resource, try again in a moment please!'
			], 'password');
		}
	}


	/**
	 * Handle an incoming request for email address change
	 *
	 * @param  Request $request
	 * @return void
	 */
	public function emailUpdate(Request $request)
	{
		$validator = Validator::make(request()->all(), [
			'email_address' => ['required', 'string', 'unique:App\Models\User,email', 'max:255'],
            'current_password' => ['required', 'current_password'],
        ]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator->errors(), 'email');
        }

		$executed = RateLimiter::attempt(
			'email-update:' . auth()->id(),
			$perMinute = 1,
			function() use ($validator) {
				$validated = $validator->validated();

				auth()->user()->update([
					'email' => $validated['email_address']
				]);
				
				return to_route('clientarea.account');
			}
		);

		if (!$executed) {
			return redirect()->back()->withErrors([
				'email_address'	=>	'You’ve reached the rate limit for this resource, try again in a moment please!'
			], 'email');
		}
	}
}
