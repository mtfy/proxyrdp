<?php

namespace App\Http\Controllers\Billing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Billing\NOWPaymentsController;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Client\RequestException;
use App\Models\User;
use Inertia\Inertia;
use App\Helpers\Helpers;
use GuzzleHttp\Client;

class NOWPaymentsController extends Controller
{
	private $base_url			=	'https://api.nowpayments.io/v1/';
	private $api_token			=	null;
	private $ipn_secret			=	null;
	private $ipn_callback_url	=	null;
	private $debug				=	false;

	/**
	 * Initialize NOWPayments API wrapper
	 *
	 * @author Motify
	 */
	public function __construct()
	{
		$this->api_token = env('NOWPAYMENTS_API_KEY', '');
		$this->ipn_secret = env('NOWPAYMENTS_IPN_SECRET', '');
		$this->ipn_callback_url = env('NOWPAYMENTS_IPN_CALLBACK_URL');
		$this->debug = (false === app()->isProduction());
	}

	
	/**
	 * Performs an integrity check against the received hash with our IPN secret.
	 *
	 * @author Motify
	 * @param  string  $signature
	 * @param  array   $payload
	 * @return boolean
	 */
	public function ipnValidateSignature(string $signature, array $payload) : bool
	{
		\ksort($payload);
		$payload = \json_encode( $payload );
		$checksum = \hash_hmac( 'sha512', $payload, $this->ipn_secret );

		return \hash_equals($checksum, $signature);
	}


	/**
	 * A wrapper around Laravel's built in HTTP client
	 *
	 * @author Motify
	 * @param  string  $path
	 * @param  string  $method
	 * @param  array   $headers
	 * @param  mixed   $body
	 * @param  integer $timeout
	 * @param  integer $retry
	 * @return array
	 */
	private function httpRequest(string $path, string $method = 'GET', array $headers = [], mixed $body = NULL, int $timeout = 3, int $retry = 3) : array
	{
		$uri = $this->base_url . $path;
		$response = [
			'success'	=>	false,
			'status'	=>	NULL,
			'error'		=>	NULL,
			'data'		=>	[]
		];

		if (!\is_null($body) && (!\is_array($body) && !\is_string($body)))
		{
			$response['error'] = ($this->debug ? 'Invalid request body.' : 'Sorry, but something went wrong. Please try again in a moment!');
			return $response;
		}

		$result = NULL;

		try {

			switch (\strtoupper($method)) {
				case 'POST': {
					// POST
					$result = Http::withHeaders($headers)
						->accept('application/json')
						->retry($retry, 1500)
						->timeout($timeout)
						->post($uri, $body);
	
					break;
				}
				default: {
					// The default method is GET
					$result = Http::withHeaders($headers)
						->accept('application/json')
						->retry($retry, 1500)
						->timeout($timeout)
						->get($uri, $body);
				}
			}
			if ($result->failed()) {
				$result->throw(function(Response $buf, RequestException $ex) {
					dd([
						'1' => 1,
						'Response' => $buf,
						'RequestException' => $ex
					]);
				});
			}

			// Process thrown errors (if any)
			// If there's no error then the chain will continue and json() will be invoked
			//
			// Thanks to https://stackoverflow.com/a/72523886/10348538
			$data = $result->throw(function($response, $e) {
				$response['success'] = false;
				$response['error'] = ($this->debug ? $e : 'Sorry, but something went wrong. Please try again in a moment!');
				return $response;
			})->json();

			$response['status'] = $result->status();

			if (\array_key_exists('error', $data))
			{
				$response['success'] = false;
				$response['error'] = ($this->debug ? $data['error'] : 'Sorry, but something went wrong. Please try again in a moment!');
				unset($data['error']);
				$response['data'] = $data;
			}
			else
			{
				$response['success'] = true;
				$response['data'] = $data;
			}

		} catch (\Exception $ex) {
			$message = $ex->getMessage();
			if (\strpos($message, 'HTTP request returned status code ') !== false) {
				$response['status'] = \intval( Helpers::getStringBetween($ex->getMessage(), 'HTTP request returned status code ', ':') );
			}
			$response['success'] = false;
			$response['error'] = ($this->debug) ? $message : 'An error occured, please try again.';
		}
		return $response;
	}


	/**
	 * Returns accurate unix timestamp (seconds since epoch)
	 * in milliseconds. Used for ByBit API
	 *
	 * @author Motify
	 * @return float
	 */
	private function getAccurateTimestamp(): float
	{
		return \floor(\microtime(true) * 1000);
	}


	/**
	 * Determine the availability of the payment processor API
	 *
	 * @author Motify
	 * @return bool
	 */
	public function getStatus() : bool
	{
		$response = $this->httpRequest(
			'status'
		);
		return ($response['success'] !== false
				&& \array_key_exists('message', $response['data'])
				&& $response['data']['message'] === 'OK');
	}

	
	/**
	 * This is a method for obtaining information about all cryptocurrencies available for payments for your current setup of payout wallets.
	 *
	 * @author Motify
	 * @return array
	 */
	public function getCurrencies() : array
	{
		$response = $this->httpRequest( 'currencies', 'GET', [
			'x-api-key'	=>	$this->api_token
		]);

		if ($response['success'] !== false && \count($response['data']) !== 0 && \array_key_exists('currencies', $response['data']) && !\is_null($response['data']['currencies']) && \is_array($response['data']['currencies']))
			$response['data'] = $response['data']['currencies'];
		else if (\array_key_exists('message', $response['data']) && !\is_null($response['data']['message']))
		{
			$response['success'] = false;
			$response['error'] = $response['data']['message'];
		}

		return $response;
	}


	/**
	 * This is a method for obtaining information about the cryptocurrencies available for payments. Shows the coins you set as available for payments in the "coins settings" tab on your personal account.
	 *
	 * @author Motify
	 * @return array
	 */
	public function getMerchantCurrencies() : array
	{
		$response = $this->httpRequest( 'merchant/coins', 'GET', [
			'x-api-key'	=>	$this->api_token
		]);

		if ($response['success'] !== false && \count($response['data']) !== 0 && \array_key_exists('selectedCurrencies', $response['data']) && !\is_null($response['data']['selectedCurrencies']) && \is_array($response['data']['selectedCurrencies']))
			$response['data'] = $response['data']['selectedCurrencies'];
		else if (\array_key_exists('message', $response['data']) && !\is_null($response['data']['message']))
		{
			$response['success'] = false;
			$response['error'] = $response['data']['message'];
		}

		return $response;
	}


	/**
	 * Get the minimum payment amount for a specific pair.
	 * 
	 * @author Motify
	 * @param  string $currency_from
	 * @param  string $currency_to
	 * @return array
	 */
	public function getMinimumPaymentAmount(string $currency_from, string $currency_to = 'btc') : array
	{
		$response = $this->httpRequest( 'min-amount?currency_from=' . $currency_from . '&currency_to=' . $currency_to . '&fiat_equivalent=eur', 'GET', [
			'x-api-key'	=>	$this->api_token
		], NULL, 5, 2);

		if (true !== $response['success'] || (!\is_null($response['status']) && 404 === $response['status']))
		{
			$response['error'] = $this->debug ? 'Currency not found.' : 'Sorry, but something went wrong.';
		}

		return $response;
	}


	/**
	 * Get the actual information about the payment. You need to provide the ID of the payment in the request.
	 * NOTE! You should make the get payment status request with the same API key that you used in the create payment request.
	 *
	 * @author Motify
	 * @param  string $payment_id
	 * @return array
	 */
	public function getPaymentStatus(string $payment_id) : array
	{
		$response = $this->httpRequest( 'payment/' . $payment_id, 'GET', [
			'x-api-key'	=>	$this->api_token
		], NULL, 5, 2 );

		return $response;
	}


	/**
	 * Creates a payment link. With this method, the customer is required to follow the generated url to complete the payment. Data must be sent as a JSON-object payload.
	 *
	 * @author Motify
	 * @param  float  $amount
	 * @param  string $invoice_id
	 * @param  string $description
	 * @return array
	 */
	public function createInvoice(float $amount, string $invoice_id, string $description = 'RDP') : array
	{
		$id = auth()->id();
		if (\is_null($id)) {
			$id = 1;
		}

		$appName = env('APP_NAME', 'ProxyRDP');

		$description = \sprintf('%s | User ID: %d | %s', $description, $id, $appName);

		$response = $this->httpRequest('invoice', 'POST', [
			'content-type'			=>	'application/json; charset=utf-8',
			'x-api-key'				=>	$this->api_token
		], [
			'price_amount'			=>	$amount,
			'price_currency'		=>	'eur',
			'order_id'				=>	$invoice_id,
			'order_description'		=>	$description,
			'is_fee_paid_by_user'	=>	true,
			'success_url'			=>	\sprintf('%s/clientarea/invoices/%s/success', url('/'), $invoice_id),
			'cancel_url'			=>	\sprintf('%s/clientarea/invoices/%s/cancel', url('/'), $invoice_id),
			'ipn_callback_url'		=>	$this->ipn_callback_url
		]);

		return $response;
	}
}
