<?php

namespace App\Http\Controllers;

use App\Exports\BonLivraisonExport;
use Illuminate\Http\Request;
use App\Models\Entreprise;
use App\Models\Client;
use App\Models\Service;
use App\Models\Categorie;
use App\Models\BonLivraison;
use App\Models\BonLivraisonService;
use App\Models\Historique;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use Webpatser\Countries\Countries;

class BonLivraisonController extends Controller
{
    public function index()
    {
        $entreprises = Entreprise::all();
        $clients = Client::all();
        $services=Service::all();
        $categories=Categorie::all();
        $countries = (new Countries())->getList();
        $selectedClient = null; 
    
        return view('Ventes.BonLivrais', [
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
        $BonLiv->status='En attente';
    $BonLiv->save();

    $idservices = explode(",", $request->input('tab'));
    foreach ($idservices as $serviceId) {
        $BonComService = new BonLivraisonService();
        $BonComService->idBonLivr = $BonLiv->id;
        $BonComService->idService = $serviceId;
        $BonComService->save();
    }

    $client = Client::find($BonLiv->IdClient );
    
    return redirect()->route('bodyMailLivrai')->with(['success', 'Facture enregistrée avec succès.','client' => $client,'BonLiv'=> $BonLiv]);
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
        return view('Ventes.Listes.ListesbonLivraison',compact('BonLiv'));
    }
    public function showBodyMail()
    {
      
        return view('Ventes.Mail.bodyMailLivra');
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
    public function destroy(BonLivraison $BonLiv)
    {$user = Auth::user();
        Historique::create([
            'iduser' => $user->id,
            'type' => 'suppression',
            'message' => $user->name . ' a supprimé le bon de Livraison N°'.$BonLiv->id 
            
        ]);
        $BonLiv->delete();
        return redirect()->route('ListesbonLivraison')
        ->with('success', 'Bon de livraison deleted successfully.');
    }
    public function export() 
    { $user = Auth::user();
        Historique::create([
            'iduser' => $user->id,
            'type' => 'exportation',
            'message' => $user->name . ' a exporté la liste des bons de Livraisons ' 
            
        ]);
        return Excel::download(new BonLivraisonExport, 'Bon_Livraison.xlsx');
    }
    public function telecharger(Request $request,BonLivraison $facture)
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
$adresse=$request->input('adresseValue');
//dd($adresse);
   $idservices = explode(",", $request->input('tab'));
   $entreprises = Entreprise::all();
      $services = Service::whereIn('id', $idservices)->get();

        $pdf = app()->make('dompdf.wrapper');

        $pdf->loadView('upload.bonLiv', compact('client', 'date','echeance','remise','tva','montantHtva','montantTotal','services','entreprises','adresse'));

        return $pdf->download('bon_Livraison.pdf');
    
   
       
    }
}
