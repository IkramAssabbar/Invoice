<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Webpatser\Countries\Countries;
use App\Exports\FournisseurExport;
use App\Imports\FournisseurImport;
use Maatwebsite\Excel\Facades\Excel;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fournisseurs = Fournisseur::all(); 
        return view('fournisseur.fournisseurs', compact('fournisseurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = (new Countries())->getList();
        return view('fournisseur.newFournisseur',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'ice' => 'required',
        'cp' => 'required',
        'email' => 'required|email|unique:clients,email', // Vérifie l'unicité de l'adresse e-mail dans la table 'clients'
        'nom' => 'required',
        
        'adresse' => 'required',
        'ville' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $pays = $request->input('Pays');
    Fournisseur::create(array_merge($request->all(), ['pays' => $pays]));

    return redirect()->back()->with('success', 'Le fournisseur a été enregistré avec succès.');
    
}


    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fournisseur = Fournisseur::find($id);
        return view('fournisseur.editFournisseur', compact('fournisseur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fournisseur $fournisseur)
    {
        
        $request->validate([
            'nom' => 'required|string',
            'adresse' => 'required|string',
            'cp' => 'required|string',
            'email' => 'required|email|unique:fournisseurs,email,'.$fournisseur->id,
            'ice' => 'required|string',
            'pays' => 'required|string',
            'tel' => 'required|string',
            'ville' => 'required|string',
        ]);
    
        $fournisseur->update([
            'nom' => $request->input('nom'),
            'adresse' => $request->input('adresse'),
            'cp' => $request->input('cp'),
            'email' => $request->input('email'),
            'ice' => $request->input('ice'),
            'pays' => $request->input('pays'),
            'tel' => $request->input('tel'),
            'ville' => $request->input('ville'),
        ]);
            return redirect()->route('fournisseur.index')->with('success', 'Fournisseur mis à jour avec succès.');
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fournisseur = Fournisseur::findOrFail($id);

        // Supprimez le client de la base de données
        $fournisseur->delete();

        // Redirigez vers la page appropriée après la suppression
        return redirect()->route('fournisseur.index')->with('success', 'Fournisseur supprimé avec succès.');
        
    }
    public function import(Request $request)
{
    /*$request->validate([
        'file' => 'required|max:10000|mimes:xlsx,xls',
    ]);*/

    $path1 = $request->file('file')->store('temp'); 
    $path=storage_path('app').'/'.$path1;  

    Excel::import(new FournisseurImport, $path);

    return redirect()->back()->with('success', 'Fournisseurs importés avec succès.');
}
public function export()
{
    return Excel::download(new FournisseurExport(), 'fournisseurs.xlsx');
}
    
}
