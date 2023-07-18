<?php

namespace App\Http\Controllers;

use App\Exports\ServiceExport;
use App\Imports\ServiceImport;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Facture;
use Maatwebsite\Excel\Facades\Excel;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Categorie::all();
        return view('Services.AddServices', compact('categories'));
    }
    public function getServiceInfo(int $id)
    {
        $services = Service::find($id);
    
        return response()->json($services);
    }
  
    public function getServices(Request $request)
    {
        $services = Service::where('IdCategorie', $request->IdCategorie)->get();
        
        if ($services->count() > 0) {
            return response()->json($services);
        } else {
            return response()->json(['message' => 'No services found for the specified category'], 404);
        }
    }
    public function showAllServices()
    {
        $services = Service::all();
        return view('Services.ListesServices',compact('services'));
    }
    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $service=new Service();
        $service->Libelle=$request->input('Libelle');
        $service->Prix=$request->input('Prix');
        $service->Description=$request->input('Description');
        $service->IdCategorie = $request->input('Categorie');    
        $service->Tva = $request->input('Tva');      
  
          $service->save();

        return redirect()->route('AddServices')->with(['success' => 'Service enregistrée avec succès.']);


    }
public function enregistrerServices(Request $request,$id)
{
    $services = $request->input('services');

    // Convertir la chaîne JSON en tableau associatif
    $servicesArray = json_decode($services, true);

    // Récupérer la facture en fonction de l'ID
    $facture = Facture::find($id);

    // Enregistrer les services dans la table pivot
    foreach ($servicesArray as $service) {
        $facture->services()->attach($service['idService']);
    }

    // Réponse du serveur
    return response()->json(['message' => 'Services enregistrés avec succès']);
}
    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    { 
        $categories=Categorie::all();
        return view('Services.UpdateServices',['service'=>$service, 'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'Libelle' => 'required',
            'IdCategorie' => 'required',
            'Prix' => 'required',
            'Tva' => 'required',
            'Description' => 'required',
        ]);
    
        // Reste du code pour la mise à jour du service
        $service->update($request->all());
       // dd( $service);
        return redirect()->route('ListesServices')
            ->with('success', 'Services updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('ListesServices')
            ->with('success', 'Service deleted successfully.');
    }
    public function export() 
    {
        return Excel::download(new ServiceExport, 'services.xlsx');
    }
   
}
