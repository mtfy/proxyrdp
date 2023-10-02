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
	 * Initialize OrderController
	 * 
	 * @author Motify
	 */
	public function __construct()
	{

	}


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
				'is_server'			=>	false,
				'billing_amount'	=>	$price,
				'billing_type'		=>	$service['billing'],
				'bandwidth'			=>	($service['billing'] === 1 ? 1000 : 0),
				'ip_address'		=>	$ip
			]);
			
			return to_route('clientarea.services');

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
	 * Convert the server hardware properties into machine readable format
	 *
	 * @author Motify
	 * @param  array  $props
	 * @return string
	 */
	public function serializeServerProps(array $props) : string
	{
		$data = [];

		foreach ($props as $idx => $val) {
			$data[] = \intval( $val );
		}

		$data = \serialize( $data );

		return $data;
	}


	/**
	 * Convert the machine readable server hardware properties into more human redable format
	 *
	 * @author Motify
	 * @param  string $props
	 * @return array
	 */
	public function unserializeServerProps(string $data) : array
	{
		$props = [
			'cores'		=>	0,
			'memory'	=>	0,
			'storage'	=>	0,
			'ipv4'		=>	0
		];
		
		$buf = NULL;

		try {
			$buf = \unserialize( $data );
		} catch (\Exception $ex) {
			$buf = NULL;
		}

		if ( !\is_null( $buf ) )
		{
			$props['cores'] = $buf[0];
			$props['memory'] = $buf[1];
			$props['storage'] = $buf[2];
			$props['ipv4'] = $buf[3];
		}

		return $props;
	}


	/**
	 * Handle an incoming checkout request for RDPs.
	 *
	 * @param  Request $request
	 * @author Motify
	 * @return void
	 */
	public function createOrderServer(Request $request)
	{
		$user_id = auth()->id();
		if (RateLimiter::remaining('create-order:' . $user_id, $perMinute = 5)) {
			RateLimiter::hit('create-order:' . $user_id);

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
			$price = $this->calculateServerPrice($data);

			$client = new ClientController();
			
			$balance = $client->getUserBalance($user_id);

			if ($price > $balance) {
				return redirect()->back()->withErrors([
					'cores'	=>	'You have insufficient funds to place an order for this service. Please top up your balance in the wallet section of clientarea.'
				], 'servers');
			}

			$new_balance = $balance - $price;

			$client->setUserBalance($user_id, $new_balance);

			$ip = request()->ip();

			Service::create([
				'user_id'			=>	$user_id,
				'pid'				=>	NULL,
				'is_server'			=>	true,
				'billing_amount'	=>	$price,
				'billing_type'		=>	0,
				'bandwidth'			=>	0,
				'server_hardware'	=>	$this->serializeServerProps($data),
				'ip_address'		=>	$ip
			]);
			
			return to_route('clientarea.services');

		} else {
			return redirect()->back()->withErrors([
				'cores'	=>	'You’ve reached the rate limit for this resource, try again in a moment please!'
			], 'servers');
		}
	}
}
