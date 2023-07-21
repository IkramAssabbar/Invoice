@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
<div class="header pb-8 pt-5 pt-lg-5 d-flex align-items-center;" >
    <!-- Mask -->
    <span class="mask bg-gradient-grey "></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-md-12 {{ $class ?? '' }}">
            <h1 style="font-family: cursive; color:rgb(27, 140, 210);" >Vos contacts</h1>
            <h2 style="font-family: cursive; color:rgb(27, 140, 210);margin-inline-start: 15px;">Fournisseurs</h2> 
            @if (isset($description) && $description)
                    <p class="text-white mt-0 mb-5" style="background-color: rgb(59, 145, 215)">{{ $description }}</p>
                @endif
            </div>
        </div>
    </div>
</div>  
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-9">
                            <div class="input-group" style="width: 300px;">
                                <input type="text" class="form-control" id="searchInput" placeholder="Recherche">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex justify-content-end">
                                <form action="{{ route('fournisseur.create') }}" method="GET">
                                    @csrf
                                <button class="btn btn-primary mr-2" type="submit" style="background-color:rgb(27, 140, 210); width: 100px;">Ajouter </button>
                                </form>
                                <form action="{{ route('fournisseur.export') }}" method="GET">
                                    @csrf
                                <button class="btn btn-primary mr-2" type="submit" style="background-color:rgb(227, 144, 67);">Exporter vos fournisseurs</button>
                                </form>
        
                                <button class="btn btn-primary mr-2" type="button" style="background-color:rgb(227, 144, 67);"data-toggle="modal" data-target="#importModal">Importer vos fournisseurs</button>

                                <button type="submit" class="btn btn-link text-danger delete-button" id="deleteButton" style="padding: 0;background-color:rgb(215, 230, 239);  "><i class="fas fa-trash-alt"></i></button>
                                
                            </div>
                        </div>
                        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="importModalLabel">Importer des fournisseurs</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('fournisseur.import') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="file">Sélectionner un fichier</label>
                                                <input type="file" class="form-control-file" id="file" name="file">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Importer</button>
                                        </form>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="selectAll">
                                    </th>
                                    <th>Référence</th>
                                    <th>Nom</th>
                                    <th>Adresse e-mail</th>
                                    <th>Adresse</th>
                                    <th>CP</th>
                                    <th>Ville</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            @if ($fournisseurs && count($fournisseurs) > 0)
                            @foreach ($fournisseurs as $fournisseur)
                            <tr onmouseover="this.style.boxShadow='0 0 6px rgba(0, 0, 0, 0.5)';" onmouseout="this.style.boxShadow='none';"onmouseover="this.style.boxShadow = '0 0 8px rgba(0, 0, 0, 0.5)';" onmouseout="this.style.boxShadow = 'none';" onclick="window.location='{{ route('fournisseur.edit', $fournisseur->id) }}';">
                                <td>
                                    <input type="checkbox" class="fournisseurCheckbox">
                                </td>
                                <td>{{ $fournisseur->id }}</td>
                                <td>{{ $fournisseur->nom }}</td>
                                <td>{{ $fournisseur->email }}</td>
                                <td>{{ $fournisseur->adresse }}</td>
                                <td>{{ $fournisseur->cp }}</td>
                                <td>{{ $fournisseur->ville }}</td>
                                <td class="text-center align-middle">
                                    <form action="{{ route('fournisseur.destroy', $fournisseur->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger delete-button" style="padding: 0;"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var selectAllCheckbox = document.getElementById('selectAll');
        var rowCheckboxes = document.getElementsByClassName('rowCheckbox');
        var deleteButton = document.getElementById('deleteButton');

        deleteButton.style.display = 'none';

        selectAllCheckbox.addEventListener('change', function() {
            var isChecked = selectAllCheckbox.checked;

            for (var i = 0; i < rowCheckboxes.length; i++) {
                rowCheckboxes[i].checked = isChecked;
            }

            deleteButton.style.display = isChecked ? 'block' : 'none';
        });

        for (var i = 0; i < rowCheckboxes.length; i++) {
            rowCheckboxes[i].addEventListener('change', function() {
                var isAllCheckboxesChecked = true;

                for (var j = 0; j < rowCheckboxes.length; j++) {
                    if (!rowCheckboxes[j].checked) {
                        isAllCheckboxesChecked = false;
                        break;
                    }
                }

                selectAllCheckbox.checked = isAllCheckboxesChecked;

                deleteButton.style.display = isAllCheckboxesChecked ? 'block' : 'none';
            });
        }
    });
</script>
<script>
    document.getElementById('selectAll').addEventListener('change', function() {
        var checkboxes = document.getElementsByClassName('fournisseurCheckbox');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = this.checked;
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var searchInput = document.getElementById('searchInput');
        var rows = document.querySelectorAll('tbody tr');

        searchInput.addEventListener('input', function() {
            var searchTerm = searchInput.value.toLowerCase();

            rows.forEach(function(row) {
                var rowData = row.innerText.toLowerCase();

                if (rowData.includes(searchTerm)) {
                    row.style.display = ''; 
                } else {
                    row.style.display = 'none'; 
                }
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
      
        const deleteForms = document.querySelectorAll('.delete-form');

       
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Empêche la soumission par défaut du formulaire

                const confirmation = confirm('Êtes-vous sûr de vouloir supprimer ce fournisseur ?');
                if (confirmation) {
                    this.submit(); 
                }
            });
        });
    });
</script>
<script src="{{ asset('js/app.js') }}"></script>
<style>
</style>

    <br>
    @include('layouts.footers.auth')
@endsection
