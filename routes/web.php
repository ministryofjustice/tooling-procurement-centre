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

// Organisations
Route::get('/dashboard/organisations', 'App\Http\Controllers\OrganisationController@index')->name('organisations');
Route::get('/dashboard/organisations/create', 'App\Http\Controllers\OrganisationController@create')->name('organisations-create');
Route::get('/dashboard/organisations/edit/{slug}', 'App\Http\Controllers\OrganisationController@edit')->name('organisations-edit');
Route::get('/dashboard/organisations/{slug}', 'App\Http\Controllers\OrganisationController@show');
Route::post('/dashboard/organisations', 'App\Http\Controllers\OrganisationController@store');
Route::patch('/dashboard/organisations/{org}', 'App\Http\Controllers\OrganisationController@update')->name('organisations-patch');

// Teams
Route::get('/dashboard/teams', 'App\Http\Controllers\TeamController@index')->name('teams');
Route::get('/dashboard/teams/create', 'App\Http\Controllers\TeamController@create')->name('teams-create');
Route::get('/dashboard/teams/edit/{slug}', 'App\Http\Controllers\TeamController@edit')->name('teams-edit');
Route::get('/dashboard/teams/{slug}', 'App\Http\Controllers\TeamController@show');
Route::post('/dashboard/teams', 'App\Http\Controllers\TeamController@store');
Route::patch('/dashboard/teams/{team}', 'App\Http\Controllers\TeamController@update')->name('teams-patch');;

// Events
Route::resource('/dashboard/events', EventController::class);
Route::post('/dashboard/event/types', 'App\Http\Controllers\EventTypeController@store');
Route::post('/dashboard/event/types/{type}/tag', 'App\Http\Controllers\EventTypeTagController@store');

// Tags
Route::resource('/dashboard/tags', TagController::class);

// Licences
Route::patch('/dashboard/licences/{licence}', 'App\Http\Controllers\LicenceController@update');
Route::resource('/dashboard/licences', LicenceController::class);

// Tools
Route::post('/dashboard/tools', [ToolController::class, 'store'])->middleware('auth');
Route::post('/dashboard/tools/search/{search}', 'App\Http\Controllers\ToolController@find');
Route::patch('/dashboard/tools/{tool}', 'App\Http\Controllers\ToolController@update');
Route::delete('/dashboard/tools/{tool}', 'App\Http\Controllers\ToolController@destroy');
//-> tool get routes
Route::get('/dashboard/tools', 'App\Http\Controllers\ToolController@index')->name('tools');
Route::get('/dashboard/tools/create', 'App\Http\Controllers\ToolController@create')->name('tools-create');
Route::get('/dashboard/tools/{slug}', 'App\Http\Controllers\ToolController@show');

Route::post('/dashboard/tools/{tool}/tag', 'App\Http\Controllers\TagToolController@store');
Route::post('/dashboard/tools/{tool}/event', 'App\Http\Controllers\EventController@store');

require __DIR__.'/auth.php';
