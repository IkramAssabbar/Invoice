@extends('layouts.app')

@section('content')
    @include('users.partials.headerListes', [
        'title' => __('Bienvenue') . ' '. auth()->user()->name,
    ])  

    <div class="container-fluid mt--8">
        <div class="row justify-content-center">
            <div class="col-lg-16 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="col-md-3">
                        <form method="GET" action="{{ route('facture') }}">
                            <button type="submit" class="btn btn-info btn-round-lg">+ Créer une facture</button>
                        </form>
                        </div>
                        
          
                            <div class="col-md-3">
                                <form method="GET" action="{{ route('factures.export') }}" class="mb-3">
                                    <button type="submit" class="btn btn-dark btn-round-lg" >+ Exporter vos Factures</button>
                                </form>
                            </div>
                        
                        <form class="navbar-search form-inline mr-3 d-none d-md-flex ml-lg-auto">
                            <div class="form-group mb-0">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend border-dark">
                                        <span class="input-group-text"><i class="fas fa-search" style="color: black;"></i></span>
                                    </div>
                                    <input class="form-control bg-grey" placeholder="Search" type="text" style="color: black;" id="searchInputF">
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Facture</th>
                                <th scope="col">Date</th>
                                <th scope="col">Client</th>
                                <th scope="col">Montant</th>
                                <th scope="col">Statut</th>
                                <th scope="col">Échéance</th>
                                <th scope="col">Retard</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($factures as $facture)
                                <tr>
                                    <td>{{ $facture->id }}</td>
                                    <td>{{ $facture->date }}</td>
                                    <td>{{ $facture->client->nom}} {{ $facture->client->prenom}}</td>
                                    <td>{{ $facture->montantTotal }}</td>
                                    <td>{{ $facture->status }}</td>
                                    <td>{{ $facture->echeance }}</td>
                                    <td>{{ $facture->retard }}</td>
                                    <td class="text-nowrap">
                                       
                                        <form action="{{route('DeleteFacture',$facture->id)}}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var searchInput = document.getElementById('searchInputF');
        var tableRows = document.querySelectorAll('.table tbody tr');
    
        searchInput.addEventListener('input', function() {
            var searchQuery = searchInput.value.toLowerCase();
    
            tableRows.forEach(function(row) {
                var serviceColumn = row.querySelector('td:nth-child(3)');
                var serviceText = serviceColumn.textContent.toLowerCase();
    
                var otherColumn = row.querySelector('td:nth-child(4)'); // Ajoutez cette ligne pour sélectionner la deuxième colonne
                var otherText = otherColumn.textContent.toLowerCase(); // Ajoutez cette ligne pour obtenir le contenu de la deuxième colonne
    
                var otherColumn2 = row.querySelector('td:nth-child(7)'); // Ajoutez cette ligne pour sélectionner la deuxième colonne
                var otherText2 = otherColumn2.textContent.toLowerCase();

                if (serviceText.includes(searchQuery) || otherText.includes(searchQuery) || otherText2.includes(searchQuery)) 
                { // Modifiez cette condition pour inclure la deuxième colonne
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
    </script>
    @include('layouts.footers.auth')
    <style>
        .btn-round-lg{
border-radius: 40px;
}
    </style>
@endsection
