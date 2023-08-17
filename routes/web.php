<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Billing\PaymentController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RecoveryController;
use App\Http\Controllers\Orders\OrderController;
use Inertia\Inertia;

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

		Route::get('/order', [ClientController::class, 'showOrder'])
			->name('order');
		Route::prefix('order')->name('order.')->group(function () {
			Route::post('server', [OrderController::class, 'server'])->name('server');
		});

		Route::get('/invoices', [ClientController::class, 'showInvoices'])
			->name('invoices');

		Route::get('/invoice/{id}', [ClientController::class, 'showInvoice'])
			->name('invoice');

		Route::get('/servers', [ClientController::class, 'showServers'])
			->name('servers');

		Route::get('/proxies', [ClientController::class, 'showProxies'])
			->name('proxies');

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

Route::middleware(['auth'])->group(function () {
	Route::get('logout', [LoginController::class, 'destroy'])
		->name('logout');
});