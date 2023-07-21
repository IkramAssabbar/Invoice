<?php

namespace App\Http\Controllers;

use App\Exports\FacturesExport;
use App\Imports\FacturesImport;
use App\Models\Entreprise;
use App\Models\Client;
use App\Models\Service;
use App\Models\Categorie;
use App\Models\Facture;
use App\Models\FactureService;
use App\Models\Historique;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use PDF;
use Webpatser\Countries\Countries;

class FactureController extends Controller
{
  //entreprise
    public function index()
    {
        $entreprises = Entreprise::all();
        $clients = Client::all();
        $services=Service::all();
        $categories=Categorie::all();
        $countries = (new Countries())->getList();
        $selectedClient = null; 
    
        return view('Ventes.Facture', [
            'entreprises' => $entreprises,
            'clients' => $clients,
            'services'=>$services,
            'categories'=>$categories,
            'countries' =>$countries,
            'selectedClient'=>$selectedClient
        ]);
    }
    public function updateEntreprise(Request $request, Entreprise $entreprise)
    {
        $request->validate([
           
            'Nom_Commercial'=>'required',
            'Pays'=>'required',
            'Ville'=>'required',
            'CP' =>'required',
            'ICE'=>'required',
            'Telephone'=>'required',
        
        ]);

        $entreprise->update($request->all());

        return redirect()->route('facture')
            ->with('success', 'info  updated successfully.');
    }

    public function updateService(Request $request, Service $service)
    {
         $request->validate([
           
           
            ' Prix'=>'required',
             'Tva' =>'required',
             'Description'=>'required',
            
        ]);

        $service->update($request->all());

        return redirect()->route('home')
            ->with('success', 'info  updated successfully.');
    }

  
    public function create()
    {
        //
    }
   public function validatefac(Request $request)
   {
    $facture = new Facture();
    $facture->IdClient = $request->input('user_id');
    $facture->date = $request->input('date');
    $facture->echeance = $request->input('echeance');
    $facture->remise = $request->input('remise');
    $facture->tva = $request->input('TvaV');
    $facture->montantHtva = $request->input('montantHtva');
    $facture->montantTotal = $request->input('montantTotal');
         // $facture->save();

    $idservices = explode(",", $request->input('tab'));

    foreach ($idservices as $serviceId) {
        $factureService = new FactureService();
        $factureService->idFacture = $facture->id;
        $factureService->idService = $serviceId;
       // $factureService->save();
    }

    $client = Client::find($facture->IdClient );
    
    return redirect()->route('facture')->with('success', 'Facture enregistrée avec succès.');
   }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Facture $facture)
 {  $factureid = $facture->id;
    

    
        $facture = new Facture();
    $facture->IdClient = $request->input('user_id');
    $facture->date = $request->input('date');
    $facture->echeance = $request->input('echeance');
    $facture->remise = $request->input('remise');
    $facture->tva = $request->input('TvaV');
    $facture->montantHtva = $request->input('montantHtva');
    $facture->montantTotal = $request->input('montantTotal');
 $facture->status='En attente';
    $facture->save();
    $idservices = explode(",", $request->input('tab'));

    foreach ($idservices as $serviceId) {
        $factureService = new FactureService();
        $factureService->idFacture = $facture->id;
        $factureService->idService = $serviceId;
        $factureService->save();
    }
 
    $client = Client::find($facture->IdClient );
    return redirect()->route('bodyMail')->with(['success', 'Facture enregistrée avec succès.','client' => $client,'facture'=> $facture]);

   
    
    
}
    public function updateDATAEntreprise(Request $request, Entreprise $entreprise)
    {
        $request->validate([
           
            
            'IF'=>'required',
            'Patente' =>'required',
        
        
        ]);

        $entreprise->update($request->all());

        return redirect()->route('facture')
            ->with('success', 'info  updated successfully.');
    }
    public function showAllFactures()
    {
        $factures = Facture::all();
        return view('Ventes.Listes.ListesFactures',compact('factures'));
    }
    public function showBodyMail()
    {
      
        return view('Ventes.Mail.bodyMail');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function telecharger(Request $request,Facture $facture)
    {
       // $factureid = $request->input('id');

        $factureid = $facture->id;
       // $factureExistante = Facture::find($factureid);
        $IdClient = $request->input('user_id');
        $client=Client::find($IdClient);
        $date = $request->input('date');
        $echeance = $request->input('echeance');
   $remise = $request->input('remise');
    $tva = $request->input('TvaV');
   $montantHtva = $request->input('montantHtva');
   $montantTotal = $request->input('montantTotal');

   $idservices = explode(",", $request->input('tab'));
   $entreprises = Entreprise::all();
      $services = Service::whereIn('id', $idservices)->get();

        $pdf = app()->make('dompdf.wrapper');

        $pdf->loadView('upload.facture', compact('client', 'date','echeance','remise','tva','montantHtva','montantTotal','services','entreprises'));

        return $pdf->download('facture.pdf');
    
   
       
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facture $facture)
    { $user = Auth::user();
        Historique::create([
            'iduser' => $user->id,
            'type' => 'suppression',
            'message' => $user->name . ' a supprimé la facture ' . $facture->id,
           
        ]);
       $facture->delete();
       
   
        return redirect()->route('Listesfacture')
            ->with('success', 'Service deleted successfully.');
    }
    public function export() 
    {  $user = Auth::user();
        Historique::create([
            'iduser' => $user->id,
            'type' => 'exportation',
            'message' => $user->name . ' a exporté la liste des factures ' 
            
        ]);
        return Excel::download(new FacturesExport, 'factures.xlsx');
      
    }
       
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new FacturesImport,request()->file('file'));
        return back();
    }
    public function viewImport() {
        return view("Ventes.importFacture");
        
    }
}
