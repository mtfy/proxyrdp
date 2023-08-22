<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use Inertia\Inertia;
use Inertia\Response;

class ServicesController extends Controller
{
    

	/**
	 * Display the admin services view
	 *
	 * @author Motify
	 * @param  Request $request
	 * @return void
	 */
	public function create(Request $request)
	{
		$services = Product::select('id', 'title', 'price')->orderByDesc('created_at')->paginate(10);

		$items = $services->through(function ($service) {
			return [
				'id'	=>	$service->id,
				'title'	=>	$service->title,
				'price'	=>	\floatval( $service->price )
			];
		});

		return Inertia::render('Admin/Services/Index', [
			'services'	=>	$items
		]);
	}


	/**
	 * Handle incoming service creation
	 *
	 * @param  Request $request
	 * @return void
	 */
	public function store(Request $request)
	{
		$user_id = auth()->id();
		if (RateLimiter::remaining('create-service:' . $user_id, $perMinute = 3)) {
			RateLimiter::hit('create-service:' . $user_id);

			$validator = Validator::make(request()->all(), [
				'title'			=> ['required', 'string', 'max:64'],
				'description'	=> ['required', 'string', 'max:65535'],
				'category'		=> ['required', 'in:0,1'],
				'billing'		=> ['required', 'in:0,1'],
				'price'			=> ['required', 'regex:/^\d+(\.\d{1,2})?$/']
			]);

			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator->errors(), 'addService');
			}

			$validator = $validator->validated();

			Product::create([
				'title' => $validator['title'],
				'description' => $validator['description'],
				'category' => $validator['category'],
				'billing' => $validator['billing'],
				'price' => \floatval( $validator['price'] ),
				'created_by' => $user_id,
				'updated_by' => $user_id,
			]);
			
			return to_route('admin.services');


		} else {
			return redirect()->back()->withErrors([
				'title'	=>	'You’ve reached the rate limit for this resource, try again in a moment please!'
			], 'addService');
		}
	}


	/**
	 * Display invidual service admin view
	 *
	 * @author Motify
	 * @param  Request $request
	 * @param  string  $id
	 * @return void
	 */
	public function view(Request $request, string $id)
	{
		$service = Product::select('id', 'title', 'description', 'category', 'price', 'billing', 'disabled', 'created_by', 'updated_by', 'created_at', 'updated_at')
			->where(['id' => $id])
			->first();

		if (!\is_null($service))
			$service = $service->toArray();

		return Inertia::render('Admin/Services/View', [
			'service'	=>	$service
		]);
	}


	/**
	 * Handle incoming service edit
	 *
	 * @param  Request $request
	 * @return void
	 */
	public function edit(Request $request, string $id)
	{
		$user_id = auth()->id();
		if (RateLimiter::remaining('edit-service:' . $user_id, $perMinute = 10)) {
			RateLimiter::hit('edit-service:' . $user_id);

			$exists = Product::select('id')->where(['id' => $id])->first();
			if (\is_null($exists)) {
				return redirect()->back()->withErrors([
					'title'	=>	'Sorry, but this service does not exist.'
				]);
			}

			$validator = Validator::make(request()->all(), [
				'title'			=> ['required', 'string', 'max:64'],
				'description'	=> ['required', 'string', 'max:65535'],
				'category'		=> ['required', 'in:0,1'],
				'billing'		=> ['required', 'in:0,1'],
				'price'			=> ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
				'disabled'		=> ['nullable']
			]);

			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator->errors());
			}

			$validator = $validator->validated();

			$disabled = false;
			if ($request->has('disabled'))
				$disabled = ($request->disabled !== false);

			Product::where(['id' => $id])->update([
				'title' => $validator['title'],
				'description' => $validator['description'],
				'category' => $validator['category'],
				'billing' => $validator['billing'],
				'price' => \floatval( $validator['price'] ),
				'disabled' => $disabled,
				'updated_by' => $user_id,
			]);
			
			return to_route('admin.services');


		} else {
			return redirect()->back()->withErrors([
				'title'	=>	'You’ve reached the rate limit for this resource, try again in a moment please!'
			], 'addService');
		}
	}
}
