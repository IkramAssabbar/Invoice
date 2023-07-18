<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("Services.AddCategories");
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
        $categorie=new Categorie();
        $categorie->Nom_Categorie=$request->input('categorieName');
         
          $categorie->save();

        return redirect()->route('AddServices')->with(['success' => 'categorie enregistrée avec succès.']);


    }
    public function store2(Request $request)
    {
        $categorie=new Categorie();
        $categorie->Nom_Categorie=$request->input('categorieName');
         
          $categorie->save();

        return redirect()->route('AddCategorie')->with(['success' => 'categorie enregistrée avec succès.']);


    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $category = Categorie::find($id);
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        return view('Services.UpdateCategorie',compact('categorie'));

    }

    public function showAllCategories(Categorie $categorie)
    {
        $categories= Categorie::all();
        return view('Services.ListesCategories',compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie $categorie)
    {
        $request->validate([
            'Nom_Categorie'=>'required',
        ]

        );
        $categorie->update($request->all());
         
         return redirect()->route('ListesCategorie')
             ->with('success', 'categorie updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return redirect()->route('ListesCategorie')
        ->with('success', 'Categorie deleted successfully.');
    }

}
