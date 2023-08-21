<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class ServicesController extends Controller
{
    

	/**
	 * Display the admin services view
	 *
	 * @param  Request $request
	 * @author Motify
	 * @return void
	 */
	public function show(Request $request)
	{
		return Inertia::render('Admin/Services');
	}
}
