<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ClientController;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class RecoveryController extends Controller
{
    /**
     * Display the account recovery view.
     */
    public function create() : Response
	{
		return Inertia::render('Auth/Recover');
	}

	/**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
		$validator = Validator::make(request()->all(), [
			'email' => ['required', 'string', 'email', 'max:255'],
        ]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator->errors());
        }
		
		return to_route('clientarea.login.recover');
	}
}
