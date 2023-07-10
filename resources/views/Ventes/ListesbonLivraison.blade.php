@extends('layouts.app')

@section('content')
<div class="header pb-8 pt-5 pt-lg-5 d-flex align-items-center;" >
    <!-- Mask -->
    <span class="mask bg-gradient-grey "></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-md-12 {{ $class ?? '' }}">
             
            <h1 style="font-family: cursive; color:rgb(27, 164, 210);" >Liste des Bons de Livraison </h1>
                
            </div>
        </div>
    </div>
</div> 


    <div class="container-fluid mt--8">
        <div class="row justify-content-center">
            <div class="col-lg-16 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        
                        <form method="GET" action="{{ route('bonLivraison') }}">
                            <button type="submit" class="btn btn-success btn-round-lg">+ Créer un Bon de Livraison </button>
                        </form>
                        <form class="navbar-search form-inline mr-3 d-none d-md-flex ml-lg-auto">
                            <div class="form-group mb-0">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend border-dark">
                                        <span class="input-group-text"><i class="fas fa-search" style="color: black;"></i></span>
                                    </div>
                                    <input class="form-control bg-grey" placeholder="Search" type="text" style="color: black;">
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Bon de Livraison</th>
                                <th scope="col">Date</th>
                                <th scope="col">Client</th>
                                <th scope="col">Montant</th>
                                <th scope="col">Statut</th>
                                <th scope="col">Date Livraison</th>
                                <th scope="col">Retard</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($BonLiv as $BonLiv)
                                <tr>
                                    <td>{{ $BonLiv->id }}</td>
                                    <td>{{ $BonLiv->date }}</td>
                                    <td>{{ $BonLiv->client->nom}} {{ $BonLiv->client->prenom}}</td>
                                    <td>{{ $BonLiv->montantTotal }}</td>
                                    <td>{{ $BonLiv->statut }}</td>
                                    <td>{{ $BonLiv->echeance }}</td>
                                    <td>{{ $BonLiv->retard }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
    <style>
        .btn-round-lg{
border-radius: 40px;
}
    </style>
@endsection
