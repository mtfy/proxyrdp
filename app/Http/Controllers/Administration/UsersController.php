<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersController extends Controller
{
    

	/**
	 * Display the admin users view
	 *
	 * @param  Request $request
	 * @author Motify
	 * @return void
	 */
	public function create(Request $request)
	{
		$users = User::select('id', 'email', 'username', 'balance', 'created_at')->orderByDesc('id')->paginate(50)->through(function ($user) {
			return [
				'id'			=>	$user->id,
				'email'			=>	$user->email,
				'username'		=>	$user->username,
				'balance'		=>	$user->balance,
				'created_at'	=>	\strtotime( $user->created_at ),	// Convert into UNIX timestamp to be compatible with localization using moment.js on client-side
				'roles'			=>	$user->getRoleNames()->toArray()
			];
		});

		return Inertia::render('Admin/Users/Index', [
			'users'	=>	$users
		]);
	}


	/**
	 * Display user profile view
	 *
	 * @author Motify
	 * @param  Request $request
	 * @param  string  $id
	 * @return void
	 */
	public function profile(Request $request, string $id)
	{
		$user = User::select('id', 'email', 'username', 'balance', 'created_at', 'updated_at')
			->where(['id' => $id])
			->first();

		if (!\is_null($user))
		{
			$roles = $user->getRoleNames()->toArray();
			$user = $user->toArray();
			$user['roles'] = $roles;
			
			// Convert into UNIX timestamp to be compatible with localization using moment.js on client-side
			$user['created_at'] = \strtotime( $user['created_at'] );
			$user['updated_at'] = \strtotime( $user['updated_at'] );
		}

		return Inertia::render('Admin/Users/Profile', [
			'data'	=>	$user
		]);
	}


	/**
	 * Handle incoming profile update request from admin control panel
	 *
	 * @author Motify
	 * @param  Request $request
	 * @param  string  $id
	 * @return void
	 */
	public function updateProfile(Request $request, string $id)
	{
		$user_id = auth()->id();

		if (RateLimiter::remaining('edit-user:' . $user_id, $perMinute = 10)) {
			RateLimiter::hit('edit-user:' . $user_id);

			$user = User::select('id', 'email', 'username', 'balance', 'created_at', 'updated_at')
				->where(['id' => $id])
				->first();

			if (\is_null($user))
			{
				return redirect()->back()->withErrors([
					'username'	=>	'Sorry, but this user does not exist.'
				], 'editProfile');
			}

			$validator = Validator::make(request()->all(), [
				'username' 	=>	['required', 'string', 'min:3', 'max:16', 'unique:App\Models\User,username,'  . $user['id']],	// See: https://stackoverflow.com/a/28198980
            	'email' 	=>	['required', 'string', 'email', 'max:255', 'unique:App\Models\User,email,' . $user['id']],		// See: https://stackoverflow.com/a/28198980
				'balance'	=>	['required', 'regex:/^\d+(\.\d{1,2})?$/'],
				'admin'		=>	['nullable']
			]);

			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator->errors(), 'editProfile');
			}

			$validator = $validator->validated();

			if ($request->has('admin'))
			{
				if ($request->admin && !$user->hasRole('Administrator'))
				{
					// Assign the user administrator privileges
					try {
						$user->assignRole('Administrator');
					} catch ( \Throwable $error ) { /* What did you expect me to do? */ }
				}
				else if (!$request->admin && $user->hasRole('Administrator'))
				{

					// Remove the user administrator privileges
					try {
						$user->removeRole('Administrator');
					} catch ( \Throwable $error ) { /* What did you expect me to do? */ }

				}
			}

			User::where(['id' => $id])->update([
				'username'	=>	$validator['username'],
				'email'		=>	$validator['email'],
				'balance'	=>	\floatval( $validator['balance'] ),
			]);

			return to_route('admin.users.profile', $id);

		} else {
			return redirect()->back()->withErrors([
				'username'	=>	'You’ve reached the rate limit for this resource, try again in a moment please!'
			], 'editProfile');
		}
	}
}
