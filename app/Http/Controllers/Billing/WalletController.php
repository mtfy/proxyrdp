<?php

namespace App\Http\Controllers\Billing;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Billing\NOWPaymentsController;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;
use App\Helpers\Helpers;
use Inertia\Inertia;
use Inertia\Response;

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
		return Inertia::render('Clientarea/Wallet');
	}

}
