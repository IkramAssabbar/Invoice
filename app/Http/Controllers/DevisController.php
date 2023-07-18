<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Devis;
use App\Models\Service;
use Illuminate\Http\Request;
use Webpatser\Countries\Countries;
use Illuminate\Support\Facades\Response;

use TCPDF;
use Carbon\Carbon;

class DevisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = (new Countries())->getList();
        $clients = Client::all();
        $selectedClient = null; 
    
        return view('devis.devi', compact('countries', 'clients', 'selectedClient'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Devis $devis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Devis $devis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Devis $devis)
    {
        //
    }


    public function telecharger(Request $request)
    {
        $devisId = $request->input('id');

        $devis = Devis::find(1);

        if (!$devis) {
            return redirect()->back()->with('error', 'Devis introuvable.');
        }
        $client = Client::find($devis->IdClient);

        if (!$client) {
            return redirect()->back()->with('error', 'Client introuvable.');
        }
    
        $service = Service::find($devis->IdService);
    
        if (!$service) {
            return redirect()->back()->with('error', 'Service introuvable.');
        }

        $pdf = app()->make('dompdf.wrapper');

        $pdf->loadView('uploadd.devi', compact('devis', 'client','service'));

        return $pdf->download('devis.pdf');
    }

}
