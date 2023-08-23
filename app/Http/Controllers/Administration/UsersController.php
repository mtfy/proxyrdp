<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
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
		$users = User::select('id', 'email', 'first_name', 'last_name', 'balance', 'created_at')->orderByDesc('id')->paginate(50)->through(function ($user) {
			return [
				'id'			=>	$user->id,
				'email'			=>	$user->email,
				'first_name'	=>	$user->first_name,
				'last_name'		=>	$user->last_name,
				'balance'		=>	$user->balance,
				'created_at'	=>	$user->created_at,
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
		$user = User::select('id', 'email', 'first_name', 'last_name', 'balance', 'created_at')
			->where(['id' => $id])
			->first();

		if (!\is_null($user))
		{
			$roles = $user->getRoleNames()->toArray();
			$user = $user->toArray();
			$user['roles'] = $roles;
		}

		return Inertia::render('Admin/Users/Profile', [
			'data'	=>	$user
		]);
	}
}
