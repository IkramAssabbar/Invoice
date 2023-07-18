<?php

namespace App\Http\Controllers;

use App\Exports\BonCommandExport;
use Illuminate\Http\Request;
use App\Models\Entreprise;
use App\Models\Client;
use App\Models\Service;
use App\Models\Categorie;
use App\Models\BonCommande;
use App\Models\BonCommandeService;
use App\Models\Historique;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
class BonCommandeController extends Controller
{
    
    public function index()
    {
        $entreprises = Entreprise::all();
        $clients = Client::all();
        $services=Service::all();
        $categories=Categorie::all();
    
        return view('Ventes.bonCommande', [
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

        return redirect()->route('bonCommnd')
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
        $BonCom = new BonCommande();
    $BonCom->IdClient = $request->input('user_id');
    $BonCom->date = $request->input('date');
    $BonCom->dateLivraison = $request->input('echeance');
    $BonCom->remise = $request->input('remise');
    $BonCom->tva = $request->input('TvaV');
    $BonCom->montantHtva = $request->input('montantHtva');
    $BonCom->montantTotal = $request->input('montantTotal');
    $BonCom->save();

    $idservices = explode(",", $request->input('tab'));
    foreach ($idservices as $serviceId) {
        $BonComService = new BonCommandeService();
        $BonComService->idBonCommd = $BonCom->id;
        $BonComService->idService = $serviceId;
        $BonComService->save();
    }

    $client = Client::find($BonCom->IdClient );
    
    return redirect()->route('bodyMailCmd')->with(['success', 'Facture enregistrée avec succès.','client' => $client,'BonCom'=>$BonCom]);
}
    public function updateDATAEntreprise(Request $request, Entreprise $entreprise)
    {
        $request->validate([
           
            
            'IF'=>'required',
            'Patente' =>'required',
        
        
        ]);

        $entreprise->update($request->all());

        return redirect()->route('bonCommnd')
            ->with('success', 'info  updated successfully.');
    }
    public function showAllBonCommande()
    {
        $bonComm = BonCommande::all();
        return view('Ventes.ListesBonCmd',compact('bonComm'));
    }
    public function showBodyMail()
    {
      
        return view('Ventes.bodyMailCmd');
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
    public function destroy(BonCommande $bonComm)
    { $user = Auth::user();
        Historique::create([
            'iduser' => $user->id,
            'type' => 'suppression',
            'message' => $user->name . ' a supprimé le bon de commande N°'.$bonComm->id 
            
        ]);
        $bonComm->delete();
        return redirect()->route('ListesbonCommnd')
            ->with('success', 'Service deleted successfully.');
    }
    public function export() 
    {
        $user = Auth::user();
        Historique::create([
            'iduser' => $user->id,
            'type' => 'exportation',
            'message' => $user->name . ' a exporté la liste des bons de Commandes ' 
            
        ]);
        return Excel::download(new BonCommandExport, 'Bon_Commande.xlsx');
    }
       
}
