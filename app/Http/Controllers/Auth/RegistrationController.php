<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ClientController;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;

class RegistrationController extends Controller
{

	/**
     * Display the registration view.
     */
    public function create() : Response
	{
		return Inertia::render('Auth/Register');
	}


	/**
     * Handle an incoming registration request.
     */
	public function store(Request $request) : RedirectResponse
	{
		$password_rule = (app()->isProduction()) ? Password::min(8)->letters()->numbers() : Password::min(6);

		$validator = Validator::make(request()->all(), [
			'first_name' => ['required', 'string', 'min:2', 'max:128'],
			'last_name' => ['required', 'string', 'min:2', 'max:128'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:App\Models\User,email'],
            'password' => ['required', 'confirmed', $password_rule],
        ]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator->errors());
        }

		$validator = $validator->validated();

		$user = User::create([
			'first_name' => $validator['first_name'],
			'last_name' => $validator['last_name'],
            'email' => $validator['email'],
            'password' => Hash::make($validator['password'])
        ]);

		event(new Registered($user));

		Auth::login($user);

		return redirect()->intended('/clientarea/');;
	}
}
