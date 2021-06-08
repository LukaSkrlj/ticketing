<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ContactController,
    UserController,
    TicketController,
    DashboardController
};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('/test', function () {
    return view('test');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'display'])->name('dashboard');

    Route::resource('contacts', ContactController::class);

    Route::resource('tickets', TicketController::class);

    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';

