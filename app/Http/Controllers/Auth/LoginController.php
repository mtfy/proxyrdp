<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ClientController;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
	/**
	 * Display the login view.
	 *
	 * @author Motify
	 * @return Response
	 */
    public function create() : Response
	{
		return Inertia::render('Auth/Login');
	}

	/**
	 * Handle an incoming authentication request.
	 *
	 * @author Motify
	 * @param  Request          $request
	 * @return RedirectResponse
	 */
    public function store(Request $request): RedirectResponse
    {
			$validator = Validator::make(request()->all(), [
				'email' => ['required', 'string', 'email', 'max:255'],
				'password' => ['required', 'string']
			]);

			if ($validator->fails())
			{
				return redirect()->back()->withErrors($validator->errors());
			}

		$validator = $validator->validated();

		$userData = [
			'email' => $validator['email'],
			'password' => $validator['password']
		];

		$rememberMe = ($request->has('remember')) ? true : false;

		if (Auth::attempt($userData, $rememberMe)) {
			return redirect()->intended('/clientarea/');
		}
		else
		{
			return redirect()->back()->withErrors([
				'username'	=>	'Invalid email and/or password.'
			]);
		}
    }

    /**
	 * Destroy an authenticated session.
	 *
	 * @param  Request          $request
	 * @return RedirectResponse
	 */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended('/');
    }
}
