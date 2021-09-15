<?php

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


require __DIR__.'/auth.php';


// Events
Route::resource('/events', EventController::class);

// Tags
Route::resource('/tags', TagController::class);

// Licences
Route::patch('/licences/{licence}', 'App\Http\Controllers\LicenceController@update');
Route::resource('/licences', LicenceController::class);

// Tools
Route::patch('/tools/{tool}', 'App\Http\Controllers\ToolController@update');
Route::delete('/tools/{tool}', 'App\Http\Controllers\ToolController@destroy');
Route::resource('/tools', ToolController::class);

Route::post('/tools/{tool}/tag', 'App\Http\Controllers\TagToolController@store');
Route::post('/tools/{tool}/event', 'App\Http\Controllers\EventController@store');
