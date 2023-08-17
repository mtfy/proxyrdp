<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helpers;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Billing\NOWPaymentsController;
use App\Http\Controllers\Billing\PaymentController;

class ClientController extends Controller
{

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
			'first_name' => NULL,
			'last_name' => NULL,
			'email' => NULL,
			'created_at' => NULL,
			'token' => NULL
		];
		$user = request()->user();

		if (!\is_null($user)) {
			$data['guest'] = false;
			$data['id'] = $user['id'];
			$data['first_name'] = $user['first_name'];
			$data['last_name'] = $user['last_name'];
			$data['email'] = $user['email'];
			$data['created_at'] = $user['created_at']->setTimezone(new \DateTimeZone('UTC'))->getTimestamp();
			$data['token'] = encrypt(Cookie::get('proxyrdp_session'));
		}

		return $data;
	}

	/**
	 * Display the clientarea index view
	 *
	 * @return void
	 */
	public function showIndex()
	{
		return Inertia::render('Clientarea/Index');
	}

	/**
	 * Display the clientarea order view
	 *
	 * @return void
	 */
	public function showOrder()
	{
		return Inertia::render('Clientarea/Order');
	}


	/**
	 * Display the clientarea invoices view
	 *
	 * @return void
	 */
	public function showInvoices()
	{

		$invoices = Invoice::select('id', 'invoice_id', 'amount_fiat', 'service_type', 'status', 'created_at', 'updated_at')->where('user_id', auth()->id())->orderByDesc('created_at')->paginate(15);
		$items = $invoices->through(function ($invoice) {
			$paymentController = new PaymentController();
			return [
				'invoice_id' => $invoice->invoice_id,
				'payment_id' => $invoice->id,
				'amount' => $invoice->amount_fiat,
				'service' => $invoice->service_type,
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
		$invoice = Invoice::select('id', 'invoice_id', 'amount_fiat', 'service_type', 'status', 'created_at', 'updated_at')
			->where([
				'user_id' => auth()->id(),
				'invoice_id' => $id
			])
			->first();
		
		if (!\is_null($invoice)) {
			$paymentController = new PaymentController();
			$invoice = [
				'ok'	=>	true,
				'data'	=>	[
					'invoice_id' => $invoice->invoice_id,
					'payment_id' => $invoice->id,
					'amount' => $invoice->amount_fiat,
					'service' => $invoice->service_type,
					'status' => [
						'id' => \intval($invoice->status),
						'text' => $paymentController->getPaymentStatusLabel($invoice->status)
					],
					'created_at' => $invoice->created_at,
					'updated_at' => $invoice->updated_at,
				]
			];
		}
		else
		{
			$invoice = [
				'ok'	=>	false,
				'data'	=>	[
					'invoice_id' => NULL,
					'payment_id' => NULL,
					'amount' => NULL,
					'service' => NULL,
					'status' => [
						'id' => NULL,
						'text' => NULL
					],
					'created_at' => NULL,
					'updated_at' => NULL
				]
			];
		}

		return Inertia::render('Clientarea/Invoice', [
			'invoice' => $invoice
		]);
	}
	

	/**
	 * Display the clientarea servers view
	 *
	 * @return void
	 */
	public function showServers()
	{
		return Inertia::render('Clientarea/Servers');
	}

	/**
	 * Display the clientarea proxies view
	 *
	 * @return void
	 */
	public function showProxies()
	{
		return Inertia::render('Clientarea/Proxies');
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
