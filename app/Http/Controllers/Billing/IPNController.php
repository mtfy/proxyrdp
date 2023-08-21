<?php

namespace App\Http\Controllers\Billing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helpers;
use App\Http\Controllers\Billing\NOWPaymentsController;
use App\Http\Controllers\Billing\PaymentController;
use App\Models\Payment;

class IPNController extends Controller
{

	/**
	 * Handle incoming IPN request from NOWPayments
	 *
	 * @author Motify
	 * @param Request $request
	 * @return void
	 */
	public function store(Request $request) 
	{
		$response = [
			'success'	=>	false,
			'message'	=>	NULL
		];

		$userAgent = $request->header('User-Agent');

		$validator = Validator::make(request()->all(), [
            'payment_id' => ['numeric', 'required', 'min_digits:10'],
            'parent_payment_id' => ['numeric', 'nullable'],
            'invoice_id' => ['numeric', 'required', 'min_digits:10'],
            'payment_status' => ['string', 'required', 'in:waiting,confirming,confirmed,sending,partially_paid,finished,refunded,expired'],
			'pay_address' => ['string', 'required', 'min:16', 'max:255'],
			'payin_extra_id' => ['nullable'],
			'price_amount' => ['decimal:0,2', 'required'],
			'price_currency' => ['string', 'required', 'min:2'],
			'pay_amount' => ['decimal:0,8', 'required'],
			'actually_paid' => ['decimal:0,8', 'required'],
			'actually_paid_at_fiat' => ['decimal:0,2', 'required'],
			'pay_currency' => ['string', 'required', 'min:2'],
			'order_id' => ['string', 'regex:/^[a-f0-9]{20}$/'],
			'order_description' => ['string', 'nullable'],
			'purchase_id' => ['string', 'required'],
			'updated_at' => ['numeric', 'required', 'min_digits:10'],
			'outcome_amount' => ['decimal:0,8', 'required'],
			'outcome_currency' => ['string', 'required', 'min:2'],
			'payment_extra_ids' => ['nullable']
        ]);

		if ($validator->stopOnFirstFailure()->fails()) {
			$response['message'] = 'Invalid body';
            return response()->json($response, 400);
        }

		$payload = $validator->validated();

		$paymentController = new PaymentController();
		
		
		$payment = Payment::select('token', 'invoice_id', 'payment_id', 'amount', 'status', 'currency', 'address', 'amount_crypto', 'created_at', 'updated_at')
			->where('token', $payload['order_id'])
			->first();

		if (\is_null($payment))
		{
			$response['message'] = 'Unknown invoice ID';
            return response()->json($response, 404);
		}

		$payload['updated_at'] = \DateTime::createFromFormat('U', \intval( $payload['updated_at'] / 1000 ), (new \DateTimeZone('UTC')))->format('Y.m.d H:i:s');

		$payload['payment_status'] = $paymentController->getPaymentStatusNumeric( $payload['payment_status'] );
		
		if (\is_null($payment['payment_id']))
		{
			Payment::where('token', $payload['order_id'])
				->update(['payment_id' => $payload['payment_id']]);
		}

		if (\is_null($payment['currency']) || ($payment['currency'] !== $payload['pay_currency']))
		{
			Payment::where('token', $payload['order_id'])
				->update([
					'currency'		=>	$payload['pay_currency'],
					'address'		=>	$payload['pay_address'],
					'amount_crypto'	=>	$payload['pay_amount'],
					'updated_at'	=>	$payload['updated_at']
				]);
		}
		else if ( (!\is_null( $payment['address'] ) && !\hash_equals( $payment['address'], $payload['pay_address'] )) ||
					(!\is_null($payment['amount']) && (\floatval($payment['amount']) !== \floatval($payload['pay_amount']))) ) {
			Payment::where('token', $payload['order_id'])
				->update([
					'currency'		=>	$payload['pay_currency'],
					'address'		=>	$payload['pay_address'],
					'amount_crypto'	=>	$payload['pay_amount'],
					'updated_at' => $payload['updated_at']
				]);
		}

		if ($payload['payment_status'] !== \intval( $payment['status'] ))
		{
			Payment::where('token', $payload['order_id'])
				->update([
					'status' =>	$payload['payment_status'],
					'updated_at' => $payload['updated_at']
				]);
			
			if (2 === $payload['payment_status'])
			{
				// Handle set user balance
			}
		}

		

		$response['success'] = true;
		return response()->json($response, 200);

	}
    
}
