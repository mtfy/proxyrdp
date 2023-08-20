<?php

namespace App\Http\Controllers\Billing;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Billing\NOWPaymentsController;
use App\Http\Controllers\Billing\PaymentController;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use App\Helpers\Helpers;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;


class WalletController extends Controller
{
	/**
	 * Initialize WalletController
	 *
	 * @author Motify
	 */
    public function __construct()
	{

	}


	/**
	 * Display the main wallet view
	 *
	 * @author Motify
	 * @return Response
	 */
	public function create() : Response
	{
		$invoices = Payment::select('id', 'invoice_id', 'amount', 'status', 'created_at', 'updated_at')->where('user_id', auth()->id())->orderByDesc('created_at')->paginate(15);
		$items = $invoices->through(function ($invoice) {
			$paymentController = new PaymentController();
			return [
				'invoice_id' => $invoice->invoice_id,
				'payment_id' => $invoice->id,
				'amount' => $invoice->amount,
				'status' => $paymentController->getPaymentStatusLabel($invoice->status),
				'created_at' => $invoice->created_at,
				'updated_at' => $invoice->updated_at
			];
		});

		return Inertia::render('Clientarea/Wallet/Index', [
			'items'	=>	$items
		]);
	}


	/**
	 * Handle an incoming registration request.
	 *
	 * @author Motify
	 * @return RedirectResponse
	 */
	public function store()
	{
		$user_id = auth()->id();
		if (RateLimiter::remaining('create-order:' . $user_id, $perMinute = 5)) {
			RateLimiter::hit('create-order:' . $user_id);

			$NOWPayments = new NOWPaymentsController();

			$enabled = $NOWPayments->getStatus();

			if (!$enabled) {
				return redirect()->back()->withErrors([
					'payment_method'	=>	'Sorry, but our payment processor API is temporarily unavailable. Please try again soon.'
				], 'addFunds');
			}

			$validator = Validator::make(request()->all(), [
				'payment_method' => ['required', 'in:1,2'],
				'payment_amount' => ['required', 'regex:/^\d+(\.\d{1,2})?$/']
			]);

			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator->errors(), 'addFunds');
			}

			$validator = $validator->validated();

			$amount = \floatval($validator['payment_amount']);
			$method = \intval($validator['payment_method']);

			if ($amount < 5) {
				return redirect()->back()->withErrors([
					'payment_amount'	=>	'Sorry, but the minimum amount is 5.00 €.'
				], 'addFunds');
			}


			switch ($method) {

				// Handle crypto
				case 1: {
					$paymentController = new PaymentController();
					$id = $paymentController->generateInvoiceId();
			
					$invoice = $NOWPayments->createInvoice(
						$amount,
						$id,
						'Add Balance'
					);

					if (true !== $invoice['success'] || $invoice['status'] !== 200) {
						$message = (!\is_null($invoice['error'])) ? $invoice['error'] : 'Sorry, but something went wrong. Please try again in a moment.';
						return redirect()->back()->withErrors([
							'payment_method'	=>	$message
						], 'addFunds');
					}

					$invoice = $invoice['data'];
			
					Payment::create([
						'payment_id'		=>	$invoice['id'],
						'invoice_id'		=>	$id,
						'user_id'			=>	auth()->id(),
						'amount'			=>	$amount,
						'status'			=>	0,
						'updated_at'		=>	(new \DateTime($invoice['updated_at'], new \DateTimeZone('UTC'))),
						'created_at'		=>	(new \DateTime($invoice['created_at'], new \DateTimeZone('UTC')))	
					]);


					return Inertia::location('https://href.li/?https://nowpayments.io/payment/?iid=' . $invoice['id']);
				}

				// Handle PayPal
				case 2: {
					return redirect()->back()->withErrors([
						'payment_method'	=>	'PayPal Friends & Family payments are available only to our trusted customers. To be verified as an trusted customer, you will either need to be an trusted member on any forum, or have an history with previous orders from us. Contact us to apply for paypal payments.'
					], 'addFunds');
				}
			}

		} else {
			return redirect()->back()->withErrors([
				'payment_method'	=>	'You’ve reached the rate limit for this resource, try again in a moment please!'
			], 'addFunds');
		}
	}

}
