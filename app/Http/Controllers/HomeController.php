<?php

namespace App\Http\Controllers;

use App\Models\Historique;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $historiques=Historique::all();
        return view('dashboard',compact('historiques'));
    }
}
