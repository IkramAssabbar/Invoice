<?php

use App\Http\Controllers\AchatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\FactureReccurentesController;
use App\Http\Controllers\BonCommandeController;
use App\Http\Controllers\BonLivraisonController;
use App\Http\Controllers\CategorieChController;
use Illuminate\Support\Facades\Auth;




/*
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



Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
//	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);

//facture function 
Route::get('/factures', [FactureController::class, 'index'])->name('facture');
Route::get('/Listesfactures', [FactureController::class, 'showAllFactures'])->name('Listesfacture');
Route::get('/bodyMail', [FactureController::class, 'showBodyMail'])->name('bodyMail');
Route::put('/factures/{entreprise}', [FactureController::class, 'updateEntreprise'])->name('entreprise.update');
Route::put('/factures/Data/{entreprise}', [FactureController::class, 'updateDATAEntreprise'])->name('DATA.update');
Route::post('/factures', [FactureController::class, 'store'])->name('Factures.store');
Route::delete('/DeleteFactures/{facture}', [FactureController::class, 'destroy'])->name('DeleteFacture');

//Route::put('/factures /{service}', [FactureController::class, 'updateService'])->name('service.update');


Route::get('/sendmailreccurent', [MailController::class, 'indexrecu'])->name("sendMailReccure");
Route::get('/sendmail', [MailController::class, 'index'])->name("sendMail");
Route::get('/sendMailLivrai', [MailController::class, 'indexLivrai'])->name("sendMailLivrai");
Route::get('/sendMailCmd', [MailController::class, 'indexComm'])->name("sendMailCmd");


Route::get('/categories/{id}',[CategorieController::class,'show'])->name('show');
Route::get('/services/{id}', [ServiceController::class, 'getServiceInfo'])->name('services.info');
Route::get('/getServices', [ServiceController::class, 'getServices'])->name('getServices');
//factures recurrentes

Route::get('/factures_Recurentes', [FactureReccurentesController::class, 'index'])->name('factureRecurentes');
Route::get('/ListesfacturesRecurrentes', [FactureReccurentesController::class, 'showAllFactures'])->name('ListesfReccurentes');
Route::get('/bodyMailRecurentes', [FactureReccurentesController::class, 'showBodyMail'])->name('bodyMailRecurentes');
Route::put('/factures/Recurrentes/{entreprise}', [FactureReccurentesController::class, 'updateEntreprise'])->name('entrepriseR.update');
Route::put('/factures/recurenteData/{entreprise}', [FactureReccurentesController::class, 'updateDATAEntreprise'])->name('DATAR.update');
Route::post('/facturesRecurrentes', [FactureReccurentesController::class, 'store'])->name('FacturesRecurentes.store');
Route::delete('/DeleteFacRec/{facture}', [FactureReccurentesController::class, 'destroy'])->name('DeleteFactureRec');
Route::get('/facturesRecurrExport', [FactureReccurentesController::class, 'export'])->name('facturesRecurr.export');

//BON DE COMMANDE
Route::get('/BonCommnde', [BonCommandeController::class, 'index'])->name('bonCommnd');
Route::get('/ListesBonCommnde', [BonCommandeController::class, 'showAllBonCommande'])->name('ListesbonCommnd');
Route::put('/bonCommnde/{entreprise}', [BonCommandeController::class, 'updateEntreprise'])->name('entrepriseBC.update');
Route::put('/bonCommnde/Data/{entreprise}', [BonCommandeController::class, 'updateDATAEntreprise'])->name('DATABC.update');
Route::post('/bonCommndeStore', [BonCommandeController::class, 'store'])->name('bonCommnd.store');
Route::delete('/DeleteBonCm/{bonComm}', [BonCommandeController::class, 'destroy'])->name('DeleteBonCm');
Route::get('/bonCommandeExport', [BonCommandeController::class, 'export'])->name('boncomm.export');
Route::get('/bodyMailCmd', [BonCommandeController::class, 'showBodyMail'])->name('bodyMailCmd');



//bon Livraison
Route::get('/BonLivraison', [BonLivraisonController::class, 'index'])->name('bonLivraison');
Route::get('/ListesBonLivraison', [BonLivraisonController::class, 'showAllbonLivraison'])->name('ListesbonLivraison');
Route::put('/bonLivraison/{entreprise}', [BonLivraisonController::class, 'updateEntreprise'])->name('entrepriseBL.update');
Route::put('/bonLivraison/Data/{entreprise}', [BonLivraisonController::class, 'updateDATAEntreprise'])->name('DATABL.update');
Route::post('/bonLivraisonStore', [BonLivraisonController::class, 'store'])->name('bonLivraison.store');
Route::delete('/DeleteBonLiv/{BonLiv}', [BonLivraisonController::class, 'destroy'])->name('DeleteBonLiv');
Route::get('/bonLivraisonExport', [BonLivraisonController::class, 'export'])->name('bonLivrai.export');
Route::get('/bodyMailLivra', [BonLivraisonController::class, 'showBodyMail'])->name('bodyMailLivrai');


//Services  et categorie 
Route::get('/AddServices', [ServiceController::class, 'index'])->name('AddServices');
Route::get('/ListesServices', [ServiceController::class, 'showAllServices'])->name('ListesServices');
Route::post('/storeService', [ServiceController::class, 'store'])->name('service.store');
Route::post('/storeCategorie', [CategorieController::class, 'store'])->name('categorie.store');
Route::post('/storeCategories', [CategorieController::class, 'store2'])->name('categorie.store2');

Route::get('/addCategorie', [CategorieController::class, 'index'])->name('AddCategorie');
Route::get('/categories/{categorie}/edit', [CategorieController::class, 'edit'])->name('EditCategorie');
Route::put('/categories/{categorie}', [CategorieController::class, 'update'])->name('categorie.update');
Route::get('/ListesCategories', [CategorieController::class, 'showAllCategories'])->name('ListesCategorie');
Route::delete('/categories/{categorie}', [CategorieController::class, 'destroy'])->name('categorie.destroy');


//Charges et categorie
Route::get('/ListesAchats', [AchatController::class, 'index'])->name('ListesAchats');
Route::get('/AddAchats', [AchatController::class, 'create'])->name('AddAchats');
Route::post('/storeAchats', [AchatController::class, 'store'])->name('achats.store');
Route::get('/achats/{achat}/edit', [AchatController::class, 'edit'])->name('achats.edit');
Route::put('/achats/{achat}', [AchatController::class, 'update'])->name('achats.update');
Route::delete('/achats/{achat}', [AchatController::class, 'destroy'])->name('achat.destroy');




Route::get('/AddCategorieCh', [CategorieChController::class, 'create'])->name('AddCategorieCh');
Route::post('/storeCategoriech', [CategorieChController::class, 'store'])->name('categorieCh.store');
Route::get('/ListesCategorieCh', [CategorieChController::class, 'index'])->name('ListesCategorieCh');
Route::put('/categoriesch/{categorie}', [CategorieChController::class, 'update'])->name('categorieCH.update');
Route::get('/categoriesch/{categorie}/edit', [CategorieChController::class, 'edit'])->name('categoriech.edit');
Route::delete('/categoriesch/{categorie}', [CategorieChController::class, 'destroy'])->name('categoriech.delete');










Route::put('/services/{service}', [ServiceController::class, 'update'])->name('service.update');
Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('EditServices');
Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
Route::post('/factures', [FactureController::class, 'store'])->name('Factures.store');
Route::get('/servicesExport', [ServiceController::class, 'export'])->name('services.export');
Route::post('/servicesImport', [ServiceController::class, 'import'])->name('services.import');
Route::get('/servicessViewimport', [ServiceController::class, 'viewImport'])->name('Servicesview.import');



//exportation et importation de facture 
    Route::get('/facturesexport', [FactureController::class, 'export'])->name('factures.export');
    Route::post('/facturesimport', [FactureController::class, 'import'])->name('factures.import');

//exportation et importation de factures Reccurentes





	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});


Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
   return "cache deleted";
});
