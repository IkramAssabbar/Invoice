<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entreprise;
use App\Models\Client;
use App\Models\Service;
use App\Models\Categorie;
use App\Models\FactureReccurente;
use App\Models\FactureRecService;

class FactureReccurentesController extends Controller
{
    public function index()
    {
        $entreprises = Entreprise::all();
        $clients = Client::all();
        $services=Service::all();
        $categories=Categorie::all();
    
        return view('Ventes.FacturesReccurents', [
            'entreprises' => $entreprises,
            'clients' => $clients,
            'services'=>$services,
            'categories'=>$categories
            
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

        return redirect()->route('factureRecurentes')
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
   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
 {
        $factureR = new FactureReccurente();
    $factureR->IdClient = $request->input('user_id');
    $factureR->date = $request->input('date');
    $factureR->echeance = $request->input('echeance');
    $factureR->remise = $request->input('remise');
    $factureR->tva = $request->input('TvaV');
    $factureR->montantHtva = $request->input('montantHtva');
    $factureR->montantTotal = $request->input('montantTotal');
    $factureR->save();

    $idservices = explode(",", $request->input('tab'));

    foreach ($idservices as $serviceId) {
        $factureService = new FactureRecService();
        $factureService->idFactureRecu = $factureR->id;
        $factureService->idServiceRec = $serviceId;
        $factureService->save();
    }

    $client = Client::find($factureR->IdClient );
    
    return redirect()->route('bodyMailRecurentes')->with(['success', 'Facture enregistrée avec succès.','client' => $client]);
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
        $factures = FactureReccurente::all();
        return view('Ventes.ListesFacturesRecu',compact('factures'));
    }
    public function showBodyMail()
    {
      
        return view('Ventes.bodyMail');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
