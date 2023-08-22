<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    

	/**
	 * Display the admin dashboard view
	 *
	 * @param  Request $request
	 * @author Motify
	 * @return void
	 */
	public function create(Request $request)
	{
		$userCount = User::get()->count();

		return Inertia::render('Admin/Dashboard', [
			'statistics' => [
				'users' => $userCount
			]
		]);
	}
}
