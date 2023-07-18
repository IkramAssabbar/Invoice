<?php

namespace App\Http\Controllers;

use App\Models\CategorieCh;
use Illuminate\Http\Request;

class CategorieChController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoriesch=CategorieCh::all();
        return view('Achats.ListeCategorieCh',compact('categoriesch'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Achats.AddCategorieCH');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categoriech=new CategorieCh();
        $categoriech->nomCategorie=$request->input('categorieName');
        $categoriech->save();
        return redirect()->route('ListesCategorieCh')
        ->with('success', 'Categorie  a été bien ajouté');
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
    public function edit(CategorieCh $categorie)
    {
        return view('Achats.UpdateCategorCh',compact('categorie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,CategorieCh $categorie)
    {
        $request->validate([
            'nomCategorie' => 'required',
            
        ]);
   
        // Reste du code pour la mise à jour du service
        $categorie->update($request->all());
        //dd($achat);
       // dd( $service);
        return redirect()->route('ListesCategorieCh')
            ->with('success', 'Services updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategorieCh $categorie)
    {
        $categorie->delete();
        return redirect()->route('ListesCategorieCh')
        ->with('success', 'Services updated successfully.');
    }
}
