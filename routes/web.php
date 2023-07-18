<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FournisseurController;
use App\Models\Fournisseur;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
//Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::get('devis',[App\Http\Controllers\DevisController::class,'index'])->name('devis.index');
	Route::post('/clients', [App\Http\Controllers\ClientController::class,'store'])->name('client.store');
	Route::get('/client', [App\Http\Controllers\ClientController::class,'index'])->name('client.index');
	Route::get('/client/create', [App\Http\Controllers\ClientController::class, 'create'])->name('client.create');
	Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('client.destroy');
	Route::delete('/client/destroy-multiple', [ClientController::class, 'destroyMultiple'])->name('client.destroyMultiple');
	Route::get('/devis/clients/{id}', [App\Http\Controllers\ClientController::class,'show']);
	Route::get('/clients/{id}', [App\Http\Controllers\ClientController::class, 'update'])->name('client.update');
	Route::get('/fournisseur', [App\Http\Controllers\FournisseurController::class,'index'])->name('fournisseur.index');
	Route::get('/fournisseur/create', [App\Http\Controllers\FournisseurController::class, 'create'])->name('fournisseur.create');
	Route::post('/fournisseurs', [App\Http\Controllers\FournisseurController::class,'store'])->name('fournisseur.store');
	Route::delete('/fournisseurs/{fournisseur}', [App\Http\Controllers\FournisseurController::class, 'destroy'])->name('fournisseur.destroy');
	Route::get('/export/clients', [App\Http\Controllers\ClientController::class, 'export'])->name('client.export');
	Route::post('/import/clients', [App\Http\Controllers\ClientController::class, 'import'])->name('client.import');
	Route::get('/export/fournisseurs', [App\Http\Controllers\FournisseurController::class, 'export'])->name('fournisseur.export');
	Route::post('/import/fournisseurs', [App\Http\Controllers\FournisseurController::class, 'import'])->name('fournisseur.import');
	Route::post('/telecharger-devis',[App\Http\Controllers\DevisController::class,'telecharger'])->name('devis.telecharger');


	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	Route::get('map', function () {return view('pages.maps');})->name('map');
	Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

