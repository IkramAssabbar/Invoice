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
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\ProfileController;

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


//telechargement des pieces
Route::post('/telecharger-facture',[FactureController::class,'telecharger'])->name('facture.telecharger');
Route::post('/telecharger-factureRec',[FactureReccurentesController::class,'telecharger'])->name('factureRec.telecharger');
Route::post('/telecharger-bonCommande',[BonCommandeController::class,'telecharger'])->name('bonCommande.telecharger');
Route::post('/telecharger-bonLiv',[BonLivraisonController::class,'telecharger'])->name('bonLiv.telecharger');
Route::post('/telecharger-devis',[DevisController::class,'telecharger'])->name('devis.telecharger');

//envoie de mail

Route::get('/sendmailreccurent', [MailController::class, 'indexrecu'])->name("sendMailReccure");
Route::get('/sendmail', [MailController::class, 'index'])->name("sendMail");
Route::get('/sendMailLivrai', [MailController::class, 'indexLivrai'])->name("sendMailLivrai");
Route::get('/sendMailCmd', [MailController::class, 'indexComm'])->name("sendMailCmd");
Route::get('/sendMailDevis', [MailController::class, 'indexDevis'])->name("sendMailDevis");


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
Route::get('/cahrgesExport', [AchatController::class, 'export'])->name('charge.export');




Route::get('/AddCategorieCh', [CategorieChController::class, 'create'])->name('AddCategorieCh');
Route::post('/storeCategoriech', [CategorieChController::class, 'store'])->name('categorieCh.store');
Route::get('/ListesCategorieCh', [CategorieChController::class, 'index'])->name('ListesCategorieCh');
Route::put('/categoriesch/{categorie}', [CategorieChController::class, 'update'])->name('categorieCH.update');
Route::get('/categoriesch/{categorie}/edit', [CategorieChController::class, 'edit'])->name('categoriech.edit');
Route::delete('/categoriesch/{categorie}', [CategorieChController::class, 'destroy'])->name('categoriech.delete');

//client
Route::post('/clients', [ClientController::class,'store'])->name('client.store');

Route::get('/devis',[DevisController::class,'index'])->name('devis.index');
Route::get('/devis/clients/{id}', [ClientController::class,'show']);
Route::post('/devis', [DevisController::class, 'store'])->name('devis.store');
Route::get('/bodyMailDevis', [DevisController::class, 'showBodyMail'])->name('bodyMailDevis');
Route::get('/ListesDevis', [DevisController::class, 'showAlldevis'])->name('ListesDevis');
Route::get('/devisExport', [DevisController::class, 'export'])->name('devis.export');

//
Route::post('/clients', [App\Http\Controllers\ClientController::class,'store'])->name('client.store');
	Route::get('/client', [App\Http\Controllers\ClientController::class,'index'])->name('client.index');
	Route::get('/client/create', [App\Http\Controllers\ClientController::class, 'create'])->name('client.create');
	Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('client.destroy');
	Route::delete('/client/destroy-multiple', [ClientController::class, 'destroyMultiple'])->name('client.destroyMultiple');
	Route::get('/devis/clients/{id}', [App\Http\Controllers\ClientController::class,'show']);
	Route::get('/clientedit/{id}/', [App\Http\Controllers\ClientController::class, 'edit'])->name('client.edit');
	Route::put('/clientupdate/{client}', [App\Http\Controllers\ClientController::class, 'update'])->name('client.update');
	
	Route::get('/fournisseur', [App\Http\Controllers\FournisseurController::class,'index'])->name('fournisseur.index');
	Route::get('/fournisseur/create', [App\Http\Controllers\FournisseurController::class, 'create'])->name('fournisseur.create');
	Route::post('/fournisseurs', [App\Http\Controllers\FournisseurController::class,'store'])->name('fournisseur.store');
	Route::delete('/fournisseurs/{fournisseur}', [App\Http\Controllers\FournisseurController::class, 'destroy'])->name('fournisseur.destroy');
	Route::get('/fournisseur/{id}/', [App\Http\Controllers\FournisseurController::class, 'edit'])->name('fournisseur.edit');
	Route::put('/fournisseurs/{fournisseur}', [App\Http\Controllers\FournisseurController::class, 'update'])->name('fournisseur.update');

    Route::get('/export/clients', [App\Http\Controllers\ClientController::class, 'export'])->name('client.export');
	Route::post('/import/clients', [App\Http\Controllers\ClientController::class, 'import'])->name('client.import');
	Route::get('/export/fournisseurs', [App\Http\Controllers\FournisseurController::class, 'export'])->name('fournisseur.export');
	Route::post('/import/fournisseurs', [App\Http\Controllers\FournisseurController::class, 'import'])->name('fournisseur.import');

//Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit'])->name('profile');
//	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('/change-password', [App\Http\Controllers\UserController::class,'updatePassword'])->name('change.password');
	
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profileUpdate', [ProfileController::class, 'update'])->name('profile.update');



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





	//Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	//Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});


Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
   return "cache deleted";
});
