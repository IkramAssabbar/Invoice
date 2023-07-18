@extends('layouts.app')

@section('content')
<div class="header pb-8 pt-5 pt-lg-5 d-flex align-items-center;">
    <!-- Mask -->
    <span class="mask bg-gradient-grey "></span>
    <!-- Header container -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 {{ $class ?? '' }}">
                <h1 style="font-family: cursive; color:rgb(27, 164, 210);">Liste des Categories</h1>
            </div>
            
        </div>
        
    </div>
</div>
 

 

<div class="container-fluid mt--8">
    <div class="row justify-content-center">
        <div class="col-lg-16 col-md-12">
            <div class="card" style="width: 900px;">
                <div class="card-header d-flex justify-content-between">
                   
                    <form method="GET" action="{{ route('AddCategorie') }}" class="mb-3">
                        <button type="submit" class="btn btn-round-lg" style="background-color: rgb(27, 164, 210);">+ Ajouter une Categorie</button>
                    </form>
                    
                  
                    <form class="navbar-search form-inline mr-3 d-none d-md-flex ml-lg-auto">
                        <div class="form-group mb-0">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend border-dark">
                                    <span class="input-group-text">
                                        <i class="fas fa-search" style="color: black;"></i>
                                    </span>
                                </div>
                                <input class="form-control bg-grey" placeholder="Search Categories" type="text" style="color: black;" id="searchInput">
                            </div>
                        </div>
                    </form>
                </div>
                <div class=""> <!-- Ajout de la classe table-responsive -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Nom Categorie</th>

                                <th scope="col">Action</th> <!-- Nouvelle colonne -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $categorie)
                                <tr>
                                    <td class="text-nowrap">{{ $categorie->id }}</td>
                                    <td class="text-nowrap">{{ $categorie->Nom_Categorie }}</td>
                                    
                                    <td class="text-nowrap">
                                        <a href="{{route('EditCategorie',$categorie->id)}}" class="btn btn-sm" style="background-color: rgb(27, 164, 210);">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{route('categorie.destroy',$categorie->id)}}" method="POST" class="d-inline">
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
</div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var searchInput = document.getElementById('searchInput');
            var tableRows = document.querySelectorAll('.table tbody tr');
    
            searchInput.addEventListener('input', function() {
                var searchQuery = searchInput.value.toLowerCase();
    
                tableRows.forEach(function(row) {
                    var serviceColumn = row.querySelector('td:nth-child(2)');
                    var serviceText = serviceColumn.textContent.toLowerCase();
    
                    if (serviceText.includes(searchQuery)) {
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
