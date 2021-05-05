<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
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
    return view('welcome');
});

/*
Route::group(['middleware' => ['auth;sanctum', 'verified']], function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard/contacts', function(){
        return view('contacts');
    })->name('contacts');
});
*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/contacts',
    [ContactController::class, 'index'])->middleware(['auth'])->name('contacts');
Route::get('/contacts/{contact}',
    [ContactController::class, 'show'])->middleware(['auth'])->name('contacts.show');
Route::get('/contacts/{contact}/delete',
    [ContactController::class, 'destroy'])->middleware(['auth'])->name('contacts.destroy');
Route::get('/contacts/{contact}/edit',
    [ContactController::class, 'edit'])->middleware(['auth'])->name('contacts.edit');

Route::put('/contacts/{contact}',
    [ContactController::class, 'update'])->middleware(['auth'])->name('contacts.edit');


#Route::resource('/contacts', 'ContactController')->middleware(['auth']);
require __DIR__.'/auth.php';

