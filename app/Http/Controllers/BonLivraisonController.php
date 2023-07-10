<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entreprise;
use App\Models\Client;
use App\Models\Service;
use App\Models\Categorie;
use App\Models\BonLivraison;
use App\Models\BonLivraisonService;
class BonLivraisonController extends Controller
{
    public function index()
    {
        $entreprises = Entreprise::all();
        $clients = Client::all();
        $services=Service::all();
        $categories=Categorie::all();
    
        return view('Ventes.BonLivrais', [
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

        return redirect()->route('bonLivraison')
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
        $BonLiv = new BonLivraison();
    $BonLiv->IdClient = $request->input('user_id');
    $BonLiv->date = $request->input('date');
    $BonLiv->echeance = $request->input('echeance');
    $BonLiv->remise = $request->input('remise');
    $BonLiv->tva = $request->input('TvaV');
    $BonLiv->montantHtva = $request->input('montantHtva');
    $BonLiv->montantTotal = $request->input('montantTotal');
    $BonLiv->adresse = $request->input('adresseValue');
    $BonLiv->save();

    $idservices = explode(",", $request->input('tab'));
    

    $client = Client::find($BonLiv->IdClient );
    
    return redirect()->route('bodyMailRecurentes')->with(['success', 'Facture enregistrée avec succès.','client' => $client]);
}
    public function updateDATAEntreprise(Request $request, Entreprise $entreprise)
    {
        $request->validate([
           
            
            'IF'=>'required',
            'Patente' =>'required',
        
        
        ]);

        $entreprise->update($request->all());

        return redirect()->route('bonLivraison')
            ->with('success', 'info  updated successfully.');
    }
    public function showAllbonLivraison()
    {
        $BonLiv = BonLivraison::all();
        return view('Ventes.ListesbonLivraison',compact('BonLiv'));
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
