<?php

namespace App\Http\Controllers\Billing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Billing\NOWPaymentsController;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;
use Inertia\Inertia;
use Inertia\Response;
use App\Helpers\Helpers;

class PaymentController extends Controller
{

	private $payment_status		=	[
		'original'	=>	[
			'waiting'				=>		0,
			'confirming'			=>		1,
			'confirmed'				=>		2,
			'sending'				=>		3,
			'partially_paid'		=>		4,
			'finished'				=>		5,
			'refunded'				=>		6,
			'expired'				=>		7
		],
		'reverse'	=>	[
			0	=> 'Waiting for payment',
			1	=> 'Confirming',
			2	=> 'Confirmed',
			3	=> 'Sending',
			4	=> 'Partially paid',
			5	=> 'Completed',
			6	=> 'refunded',	
			7	=> 'Expired'	
		]
	];


	/**
	 * Invoke non-static methods
	 * 
	 * @auhtor Motify
	 */
	public function __construct()
	{

	}


	/**
	 * Translate numeric computer readable payment status ID into human readable text
	 *
	 * @author Motify
	 * @param  integer $status
	 * @return string
	 */
	public function getPaymentStatusLabel(int $status) : string
	{
		if (!\array_key_exists($status, $this->payment_status['reverse']))
			return 'Unknown';

		return $this->payment_status['reverse'][$status];
		
	}


	/**
	 * Generate an unique invoice identifier
	 *
	 * @author Motify
	 * @return string
	 */
	public static function generateInvoiceId() : string
	{
		return Helpers::generateRandomString('hexdec', 20);
	}


	public function currencies(Request $request)
	{
		$response = [
			'success' => false,
			'message' => NULL,
			'data' => []
		];

		if (RateLimiter::remaining('get-currencies:' . auth()->id(), $perMinute = 5)) {
			RateLimiter::hit('get-currencies:' . auth()->id());
			$NOWPayments = new NOWPaymentsController();
			$enabled = $NOWPayments->getStatus();
			if (!$enabled) {
				$response['message'] = 'Sorry, but our payment processor API is temporarily unavailable. Please try again soon.';
				return response(\json_encode($response), 200)->header('Content-Type', 'application/json');
			}
			
			$currencies = $NOWPayments->getMerchantCurrencies();
			if (!$currencies['success']) {
				$response['message'] = 'Sorry, but our payment processor API is temporarily unavailable. Please try again soon.';
			} else {
				$response['success'] = true;
				$response['data'] = $currencies['data'];
			}
			return response(\json_encode($response), 200)->header('Content-Type', 'application/json');
		} else {
			$response['message'] = 'You’ve reached the rate limit for this resource, try again in a moment please!';
			return response(\json_encode($response), 200)->header('Content-Type', 'application/json');
		}
	}
}
