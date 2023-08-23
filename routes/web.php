<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Billing\PaymentController;
use App\Http\Controllers\Billing\WalletController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RecoveryController;
use App\Http\Controllers\Orders\OrderController;
use App\Http\Controllers\Administration\DashboardController;
use App\Http\Controllers\Administration\UsersController;
use App\Http\Controllers\Administration\ServicesController;
use App\Http\Controllers\Administration\OrdersController;
use Inertia\Inertia;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Home');
})->name('Home');

Route::middleware('guest')->group(function () {
	Route::prefix('clientarea')->name('clientarea.')->group(function () {

		Route::get('/login', [LoginController::class, 'create'])->name('login');
		Route::post('/login', [LoginController::class, 'store'])->name('login');


		Route::get('/register', [RegistrationController::class, 'create'])->name('register');
		Route::post('/register', [RegistrationController::class, 'store'])->name('register');

		Route::prefix('login')->name('login.')->group(function () {
			Route::get('/recover', [RecoveryController::class, 'create'])->name('recover');
			Route::post('/recover', [RecoveryController::class, 'store'])->name('recover');
		});
	});
});

Route::middleware(['auth', 'verified'])->group(function () {
	Route::prefix('clientarea')->name('clientarea.')->group(function () {

		Route::get('/', [ClientController::class, 'showIndex'])
			->name('index');

		Route::get('/balance', function(Request $request) {
			
		});

		Route::get('/order', [OrderController::class, 'create'])
			->name('order');
		Route::prefix('order')->name('order.')->group(function () {
			
			Route::get('/create/{id}', [OrderController::class, 'view'])->name('create');
			Route::post('/create/{id}', [OrderController::class, 'createOrder'])->name('create');

			Route::post('server', [OrderController::class, 'server'])->name('server');
		});

		Route::get('/invoices', [ClientController::class, 'showInvoices'])
			->name('invoices');

		Route::get('/invoices/{id}', [ClientController::class, 'showInvoice'])
			->name('invoice');

		Route::get('/services', [ClientController::class, 'showServices'])
			->name('services');

		Route::get('/wallet', [WalletController::class, 'create'])
			->name('wallet');

		Route::prefix('wallet')->name('wallet.')->group(function () {
			Route::post('/topup', [WalletController::class, 'store'])->name('topup');
		});

		Route::get('/account', [ClientController::class, 'showAccount'])
			->name('account');
		
		Route::prefix('account')->name('account.')->group(function () {

			Route::post('password', [ClientController::class, 'passwordUpdate'])->name('password');
			Route::post('email', [ClientController::class, 'emailUpdate'])->name('email');
	
		});
	});

	Route::prefix('payments')->name('payments.')->group(function () {
		Route::post('currencies', [PaymentController::class, 'currencies'])->name('currencies');

	});
});

Route::middleware(['auth', 'verified', 'role:Administrator'])->group(function () {
	Route::prefix('admin')->name('admin.')->group(function () {
		
		Route::get('/dashboard', [DashboardController::class, 'create'])
			->name('dashboard');

		Route::get('/users', [UsersController::class, 'create'])
			->name('users');

		Route::prefix('users')->name('users.')->group(function () {

			Route::get('/{id}', [UsersController::class, 'profile'])
				->name('profile');

		});

		Route::get('/orders', [OrdersController::class, 'create'])
			->name('orders');

		Route::get('/services', [ServicesController::class, 'create'])
			->name('services');

		Route::prefix('services')->name('services.')->group(function () {
			
			Route::get('/{id}', [ServicesController::class, 'view'])
				->name('view');
			
			Route::post('/{id}', [ServicesController::class, 'edit'])
				->name('edit');
			
			Route::post('/create', [ServicesController::class, 'store'])->name('create');
		});
	});
});

Route::middleware(['auth'])->group(function () {
	Route::get('logout', [LoginController::class, 'destroy'])
		->name('logout');
});