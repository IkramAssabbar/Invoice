<?php

namespace App\Http\Controllers;

use App\Exports\DevisExport;
use App\Exports\devissExport;
use App\Exports\FacturesExport;
use App\Imports\devissImport;
use App\Imports\FacturesImport;
use App\Models\Categorie;
use App\Models\Client;
use App\Models\Devis;
use App\Models\DevisService;
use App\Models\Entreprise;
use App\Models\Historique;
use App\Models\Service;
use Auth;
use Illuminate\Http\Request;
use Webpatser\Countries\Countries;
use Illuminate\Support\Facades\Response;

use TCPDF;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class DevisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { $entreprises = Entreprise::all();
        $clients = Client::all();
        $services=Service::all();
        $categories=Categorie::all();
        $countries = (new Countries())->getList();
        $selectedClient = null; 
    
        return view('Ventes.Devis', [
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

        return redirect()->route('devis')
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
    public function store(Request $request,Devis $devis)
 { 
        $devis = new Devis();
    $devis->IdClient = $request->input('user_id');
    $devis->date = $request->input('date');
    $devis->echeance = $request->input('echeance');
    $devis->remise = $request->input('remise');
    $devis->tva = $request->input('TvaV');
    $devis->montantHtva = $request->input('montantHtva');
    $devis->montantTotal = $request->input('montantTotal');
 $devis->status='En attente';
    $devis->save();
    $idservices = explode(",", $request->input('tab'));

    foreach ($idservices as $serviceId) {
        $devisService = new DevisService();
        $devisService->iddevis = $devis->id;
        $devisService->idService = $serviceId;
        $devisService->save();
    }
 
    $client = Client::find($devis->IdClient );
    return redirect()->route('bodyMailDevis')->with(['success', 'devis enregistrée avec succès.','client' => $client,'devis'=> $devis]);

    }
   
    
   

    public function updateDATAEntreprise(Request $request, Entreprise $entreprise)
    {
        $request->validate([
           
            
            'IF'=>'required',
            'Patente' =>'required',
        
        
        ]);

        $entreprise->update($request->all());

        return redirect()->route('devis')
            ->with('success', 'info  updated successfully.');
    }
    public function showAlldevis()
    {
        $devis = Devis::all();
        return view('Ventes.Listes.Listesdevis',compact('devis'));
    }
    public function showBodyMail()
    {
      
        return view('Ventes.Mail.bodyMailDevis');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function telecharger(Request $request,Devis $devis)
    {
       // $devisid = $request->input('id');

        $devisid = $devis->id;
       // $devisExistante = devis::find($devisid);
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

        $pdf->loadView('upload.devis', compact('client', 'date','echeance','remise','tva','montantHtva','montantTotal','services','entreprises'));

        return $pdf->download('devis.pdf');
    
   
       
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
    public function destroy(Devis $devis)
    { $user = Auth::user();
        Historique::create([
            'iduser' => $user->id,
            'type' => 'suppression',
            'message' => $user->name . ' a supprimé la devis ' . $devis->id,
           
        ]);
       $devis->delete();
       
   
        return redirect()->route('Listesdevis')
            ->with('success', 'Service deleted successfully.');
    }
    public function export() 
    {  $user = Auth::user();
        Historique::create([
            'iduser' => $user->id,
            'type' => 'exportation',
            'message' => $user->name . ' a exporté la liste des devis ' 
            
        ]);
        return Excel::download(new DevisExport, 'devis.xlsx');
      
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
        return view("Ventes.importdevis");
        
    }

}