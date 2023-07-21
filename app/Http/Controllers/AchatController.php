<?php

namespace App\Http\Controllers;

use App\Exports\chargeExport;
use App\Models\CategorieCh;
use App\Models\Charge;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AchatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $achats=Charge::all();
        return view('Achats.ListeAchats',compact('achats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=CategorieCh::all();
        return view('Achats.AddAchats',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $achats=new Charge();
        $achats->libelle=$request->input('libelle');
        $achats->prix=$request->input('prix');
        $achats->description=$request->input('description');
        $achats->categorieid = $request->input('nomCategorie');    
        $achats->tva = $request->input('tva');      
  
          $achats->save();

        return redirect()->route('AddAchats')->with(['success' => 'Achats enregistrée avec succès.']);


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
    public function edit(Charge $achat)
    {
        $categories= CategorieCh::all();
        return view('Achats.UpdateAchats',['achat'=>$achat, 'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Charge $achat)
    {
        $request->validate([
            'libelle' => 'required',
            'categorieid' => 'required',
            'prix' => 'required',
            'tva' => 'required',
            'description' => 'required',
        ]);
   
        // Reste du code pour la mise à jour du service
        $achat->update($request->all());
        //dd($achat);
       // dd( $service);
        return redirect()->route('ListesAchats')
            ->with('success', 'Services updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Charge $achat)
    {
        $achat->delete();
        return redirect()->route('ListesAchats')
        ->with('success', 'Service deleted successfully.');
    }
    public function export() 
    {
        return Excel::download(new chargeExport, 'charges.xlsx');
    }
}
