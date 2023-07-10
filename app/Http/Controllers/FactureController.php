<?php

namespace App\Http\Controllers;
use App\Models\Entreprise;
use App\Models\Client;
use App\Models\Service;
use App\Models\Categorie;
use App\Models\Facture;
use App\Models\FactureService;
use Illuminate\Http\Request;

class FactureController extends Controller
{
  //entreprise
    public function index()
    {
        $entreprises = Entreprise::all();
        $clients = Client::all();
        $services=Service::all();
        $categories=Categorie::all();
    
        return view('Ventes.facture', [
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
   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
 {
        $facture = new Facture();
    $facture->IdClient = $request->input('user_id');
    $facture->date = $request->input('date');
    $facture->echeance = $request->input('echeance');
    $facture->remise = $request->input('remise');
    $facture->tva = $request->input('TvaV');
    $facture->montantHtva = $request->input('montantHtva');
    $facture->montantTotal = $request->input('montantTotal');
    $facture->save();

    $idservices = explode(",", $request->input('tab'));

    foreach ($idservices as $serviceId) {
        $factureService = new FactureService();
        $factureService->idFacture = $facture->id;
        $factureService->idService = $serviceId;
        $factureService->save();
    }

    $client = Client::find($facture->IdClient );
    
    return redirect()->route('bodyMail')->with(['success', 'Facture enregistrée avec succès.','client' => $client]);
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
        return view('Ventes.ListesFactures',compact('factures'));
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
