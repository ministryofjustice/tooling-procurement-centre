<?php

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

// Tooling
Route::patch('/tools/{tool}', 'App\Http\Controllers\ToolController@update');
Route::delete('/tools/{tool}', 'App\Http\Controllers\ToolController@destroy');
Route::resource('/tools', ToolController::class);

Route::post('/tools/{tool}/tag', 'App\Http\Controllers\TagToolController@store');

// Tags
Route::resource('/tags', TagController::class);
