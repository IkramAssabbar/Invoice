<?php

namespace App\Http\Controllers;

use App\Exports\ClientExport;
use App\Imports\ClientImport;
use Illuminate\Http\Request;
use App\Models\Client;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Webpatser\Countries\Countries;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
    {
        $clients = Client::all(); 
        return view('client.clients', compact('clients')); 
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = (new Countries())->getList();
        return view('client.newClient',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'ice' => 'required',
            'cp' => 'required',
            'email' => 'required|email|unique:clients,email', 
            'nom' => 'required',
            'prenom' => 'required',
            'adresse' => 'required',
            'ville' => 'required',
        ]);
    
      
    
        $pays = $request->input('Pays');
        $client=Client::create(array_merge($request->all(), ['pays' => $pays]));
  
        return redirect()->back()->with('success', 'Le client a été enregistré avec succès.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $client = Client::findOrFail($id);
        return response()->json($client);
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
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'email' => 'required|email',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        Client::where('id', $id)->update($request->only(['nom', 'email','cp','ice','if','ville','tel','adresse','prenom']));
    
        return redirect()->back()->with('success', 'Client modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);

        // Supprimez le client de la base de données
        $client->delete();

        // Redirigez vers la page appropriée après la suppression
        return redirect()->route('client.index')->with('success', 'Client supprimé avec succès.');
    }
    public function destroyMultiple(Request $request)
    {
       
        $clientIds = $request->input('client_ids');
        
        if ($clientIds && count($clientIds) > 0) {
          
            Client::whereIn('id', $clientIds)->delete();
            return redirect()->route('client.index')->with('success', 'Clients supprimés avec succès.');
        } else {
            // Redirigez vers la page appropriée si aucun client n'a été sélectionné
            return redirect()->route('client.index')->with('error', 'Aucun client sélectionné.');
        }
    }
    public function import(Request $request)
{
    /*$request->validate([
        'file' => 'required|max:10000|mimes:xlsx,xls',
    ]);*/

    $path1 = $request->file('file')->store('temp'); 
    $path=storage_path('app').'/'.$path1;  

    Excel::import(new ClientImport, $path);

    return redirect()->back()->with('success', 'Clients importés avec succès.');
}
public function export()
{
    return Excel::download(new ClientExport(), 'clients.xlsx');
}
   
}
