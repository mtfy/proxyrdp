<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\RedirectResponse;

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
			'email' => NULL
		];
		$user = request()->user();
		if (!\is_null($user)) {
			$data['guest'] = false;
			$data['id'] = $user['id'];
			$data['first_name'] = $user['first_name'];
			$data['last_name'] = $user['last_name'];
			$data['email'] = $user['email'];
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
		return Inertia::render('Clientarea/Index', [
			'user' => ClientController::getUserData()
		]);
	}

	/**
	 * Display the clientarea order view
	 *
	 * @return void
	 */
	public function showOrder()
	{
		return Inertia::render('Clientarea/Order', [
			'user' => ClientController::getUserData()
		]);
	}


	/**
	 * Display the clientarea invoices view
	 *
	 * @return void
	 */
	public function showInvoices()
	{
		return Inertia::render('Clientarea/Invoices', [
			'user' => ClientController::getUserData()
		]);
	}
	

	/**
	 * Display the clientarea servers view
	 *
	 * @return void
	 */
	public function showServers()
	{
		return Inertia::render('Clientarea/Servers', [
			'user' => ClientController::getUserData()
		]);
	}

	/**
	 * Display the clientarea proxies view
	 *
	 * @return void
	 */
	public function showProxies()
	{
		return Inertia::render('Clientarea/Proxies', [
			'user' => ClientController::getUserData()
		]);
	}

	/**
	 * Display the clientarea account settings view
	 *
	 * @return void
	 */
	public function showAccount()
	{
		return Inertia::render('Clientarea/Account', [
			'user' => ClientController::getUserData()
		]);
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
