<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\LicenceController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


// Events
Route::resource('/events', EventController::class);
Route::post('/event/types', 'App\Http\Controllers\EventTypeController@store');
Route::post('/event/types/{type}/tag', 'App\Http\Controllers\EventTypeTagController@store');

// Tags
Route::resource('/tags', TagController::class);

// Licences
Route::patch('/licences/{licence}', 'App\Http\Controllers\LicenceController@update');
Route::resource('/licences', LicenceController::class);

// Tools
Route::post('/tools', [ToolController::class, 'store'])->middleware('auth');
Route::post('/tools/search/{search}', 'App\Http\Controllers\ToolController@find');
Route::patch('/tools/{tool}', 'App\Http\Controllers\ToolController@update');
Route::delete('/tools/{tool}', 'App\Http\Controllers\ToolController@destroy');
//-> get
Route::get('/tools', 'App\Http\Controllers\ToolController@index');
Route::get('/tools/create', 'App\Http\Controllers\ToolController@create');
Route::get('/tools/{slug}', 'App\Http\Controllers\ToolController@show');

Route::post('/tools/{tool}/tag', 'App\Http\Controllers\TagToolController@store');
Route::post('/tools/{tool}/event', 'App\Http\Controllers\EventController@store');

require __DIR__.'/auth.php';
