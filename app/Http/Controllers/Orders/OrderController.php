<?php

namespace App\Http\Controllers\Orders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Billing\NOWPaymentsController;
use App\Http\Controllers\Billing\PaymentController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\User;
use App\Models\Product;
use App\Models\Payment;
use App\Models\Service;
use Inertia\Inertia;
use Inertia\Response;

class OrderController extends Controller
{
	private $serverParameters = [
		'memory'	=>	[
			'1'		=>	'2',
			'2'		=>	'4',
			'3' 	=>	'6',
			'4'		=>	'8',
			'5'		=>	'10',
			'6' 	=>	'12',
			'7'		=>	'16',
			'8'		=>	'20',
			'9'		=>	'24',
			'10'	=>	'32'
		],
		'storage'	=>	[
			'1'		=>	'50',
			'2'		=>	'100',
			'3'		=>	'150',
			'4'		=>	'200',
			'5'		=>	'400',
			'6'		=>	'500'
		]
	];


	/**
	 * Display the clientarea order view
	 *
	 * @author Motify
	 * @return void
	 */
	public function create()
	{
		$services = Product::select('id', 'title', 'description', 'price', 'billing')->where(['disabled' => false, 'category' => 0])->paginate(3)->through(function ($service) {
			$description = \explode("\n", \trim($service->description));

			return [
				'id'			=>	$service->id,
				'title'			=>	$service->title,
				'description'	=>	$description,
				'billing'		=>	\intval( $service->billing ),
				'price'			=>	\floatval( $service->price )
			];
		});

		return Inertia::render('Clientarea/Order/Index', [
			'proxies'	=>	$services
		]);
	}


	/**
	 * Display an invidual service view
	 *
	 * @param  Request $request
	 * @param  string  $id
	 * @return void
	 */
	public function view(Request $request, string $id)
	{
		$service = Product::select('id', 'title', 'description', 'price', 'billing')->where(['id' => $id, 'disabled' => false, 'category' => 0])->first();
		
		if (!\is_null($service))
			$service = $service->toArray();

		return Inertia::render('Clientarea/Order/Proxy', [
			'service'	=>	$service
		]);
	}

	/**
	 * Create order for specific service
	 *
	 * @author Motify
	 * @param  Request $request
	 * @param  string  $id
	 * @return void
	 */
	public function createOrder(Request $request, string $id)
	{
		$user_id = auth()->id();
		if (RateLimiter::remaining('create-order:' . $user_id, $perMinute = 10)) {
			RateLimiter::hit('create-order:' . $user_id);

			$service = Product::select('id', 'title', 'description', 'price', 'billing')->where(['id' => $id, 'disabled' => false, 'category' => 0])->first();
		
			if (\is_null($service)) {
				return redirect()->back()->withErrors([
					'order'	=>	'Unknown service.'
				]);
			}

			$service = $service->toArray();

			$client = new ClientController();
			
			$balance = $client->getUserBalance($user_id);
			$price = \floatval( $service['price'] );
			if ($price > $balance) {
				return redirect()->back()->withErrors([
					'order'	=>	'You have insufficient funds to place an order for this service. Please top up your balance in the wallet section of clientarea.'
				]);
			}

			$service['billing'] = \intval( $service['billing'] );

			$new_balance = $balance - $price;

			$client->setUserBalance($user_id, $new_balance);

			$ip = request()->ip();

			Service::create([
				'user_id'			=>	$user_id,
				'pid'				=>	$service['id'],
				'billing_amount'	=>	$price,
				'billing_type'		=>	$service['billing'],
				'bandwidth'			=>	($service['billing'] === 1 ? 1000 : 0),
				'ip_address'		=>	$ip
			]);
			
			return to_route('clientarea.order');

		} else {
			return redirect()->back()->withErrors([
				'order'	=>	'You’ve reached the rate limit for this resource, try again in a moment please!'
			]);
		}
	}


	/**
     * Convert client request data into genuine data conversions
     */
	public function fixOrderServerParameters(array $param) : array
	{
		if (\array_key_exists('memory', $param) && \array_key_exists($param['memory'], $this->serverParameters['memory']))
			$param['memory'] = 	$this->serverParameters['memory'][$param['memory']];

		if (\array_key_exists('storage', $param) && \array_key_exists($param['storage'], $this->serverParameters['storage']))
			$param['storage'] = $this->serverParameters['storage'][$param['storage']];

		return $param;
	}


	/**
     * Calculate the price for user's server hardware choice
     */
	private function calculateServerPrice(array $param) : float
	{
		$subtotal = (float)0.00;

		if (!\array_key_exists('cores', $param) || !\array_key_exists('memory', $param) || !\array_key_exists('storage', $param) || !\array_key_exists('ipv4', $param))
			return $subtotal;
		
		switch(\intval($param['cores'])) {
			case 2:
				$subtotal += 5.5;
				break;
			
			case 4:
				$subtotal += 11;
				break;
			
			case 6:
				$subtotal += 17.5;
				break;
			
			case 8:
				$subtotal += 25;
				break;
			
			case 10:
				$subtotal += 32;
				break;
			
			case 12:
				$subtotal += 38.5;
				break;

			default:
				$subtotal += 38.5;
		}

		switch(\intval($param['memory'])) {
			case 2:
				$subtotal += 3;
				break;
			
			case 4:
				$subtotal += 6;
				break;
			
			case 6:
				$subtotal += 9;
				break;
			
			case 8:
				$subtotal += 12;
				break;
			
			case 10:
				$subtotal += 15;
				break;
			
			case 12:
				$subtotal += 18;
				break;
			
			case 16:
				$subtotal += 18;
				break;
			
			case 20:
				$subtotal += 29.5;
				break;
			
			case 24:
				$subtotal += 35.5;
				break;
			
			case 32:
				$subtotal += 47.5;
				break;

			default:
				$subtotal += 47.5;
		}

		switch(\intval($param['storage'])) {
			case 50:
				$subtotal += 3.5;
				break;
			
			case 100:
				$subtotal += 7;
				break;
			
			case 150:
				$subtotal += 11;
				break;
			
			case 200:
				$subtotal += 14.5;
				break;
			
			case 400:
				$subtotal += 29;
				break;
			
			case 500:
				$subtotal += 36;
				break;
		}

		$subtotal += \intval($param['ipv4']) * 2;

		return $subtotal;
	}

	/**
     * Handle an incoming checkout request for RDPs.
     */
	public function server(Request $request)
	{
		if (RateLimiter::remaining('create-order:' . auth()->id(), $perMinute = 5)) {
			RateLimiter::hit('create-order:' . auth()->id());

			$NOWPayments = new NOWPaymentsController();

			$enabled = $NOWPayments->getStatus();
			
			if (!$enabled) {
				return redirect()->back()->withErrors([
					'cores'	=>	'Sorry, but our payment processor API is temporarily unavailable. Please try again soon.'
				], 'servers');
			}

			$validator = Validator::make(request()->all(), [
				'cores' => ['required', 'in:2,4,6,8,10,12'],
				'memory' => ['required', 'in:1,2,3,4,5,6,7,8,9,10'],
				'storage' => ['required', 'in:1,2,3,4,5'],
				'ipv4' => ['required', 'in:0,1,2,3,4']
			]);
	
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator->errors(), 'servers');
			}
	
			$validator = $validator->validated();

			$data = $this->fixOrderServerParameters($validator);
			$data['subtotal'] = $this->calculateServerPrice($data);

			$id = PaymentController::generateInvoiceId();
			$description = \sprintf('RDP [%s cores, %s GB RAM, % GB SSDs, %s IP]', $data['cores'], $data['memory'], $data['storage'], $data['ipv4']);
			
			$invoice = $NOWPayments->createInvoice($data['subtotal'], $id, $description);
			
			if (true !== $invoice['success'] || $invoice['status'] !== 200) {
				$message = (!\is_null($invoice['error'])) ? $invoice['error'] : 'Sorry, but something went wrong. Please try again in a moment.';
				return redirect()->back()->withErrors([
					'cores'	=>	$message
				], 'servers');
			}

			$invoice = $invoice['data'];

			$ip = request()->ip();
			
			Payment::create([
				'iid'				=>	$invoice['id'],
				'invoice_id'		=>	$invoice['order_id'],
				'user_id'			=>	auth()->id(),
				'amount'			=>	$data['subtotal'],
				'status'			=>	0,
				'ip_address'		=>	$ip,
				'updated_at'		=>	(new \DateTime($invoice['updated_at'], new \DateTimeZone('UTC'))),
				'created_at'		=>	(new \DateTime($invoice['created_at'], new \DateTimeZone('UTC')))	
			]);

			dd($invoice);



		} else {
			return redirect()->back()->withErrors([
				'cores'	=>	'You’ve reached the rate limit for this resource, try again in a moment please!'
			], 'servers');
		}
	}
}
