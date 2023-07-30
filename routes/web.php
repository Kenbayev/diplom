<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\AirlinesController;
use App\Http\Controllers\FlightsController;
use App\Http\Controllers\AirlineTicketController;
use App\Http\Controllers\BuyTicketController;
use App\Models\User;

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
    return view('dashboard');
});

Route::post('/buy_tickets', 'App\Http\Controllers\BuyTicketController@buyTicket');
Route::post('/sold', 'App\Http\Controllers\BuyTicketController@store');
Route::get('/ticket/{token}', 'App\Http\Controllers\SoldTicketController@index');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    // dd(User::get());
   
    Route::resource('tasks', \App\Http\Controllers\TasksController::class);
    
    Route::resource('users', \App\Http\Controllers\UsersController::class);

    Route::resource('airlines', AirlinesController::class);
    Route::resource('flights', FlightsController::class);
    // Route::resource('tickets', AirlineTicketController::class);
    Route::post('/tickets_add','App\Http\Controllers\AirlineTicketController@store')->name('tickets_add');
    Route::post('/tickets_by_id','App\Http\Controllers\AirlineTicketController@index');
});

Route::get('locale/{lange}', [LocalizationController::class, 'setLang']);