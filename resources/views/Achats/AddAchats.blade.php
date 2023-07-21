@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
<div class="header pb-2 pt-5 pt-lg-5 d-flex align-items-center;">
    <!-- Mask -->
    <span class="mask bg-gradient-grey "></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-md-12 {{ $class ?? '' }}">
                <h1 style="font-family: cursive; color:rgb(27, 164, 210);">Ajoutez vos achats</h1>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-8 col-md-12 col-12">
         <form method="POST" action="{{route('achats.store')}}">
            @csrf
            <div class="card border border-dark">
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                    <div class="mb-2">
                        <div role="tabpanel" id="react-aria-99-tabpane-design" aria-labelledby="react-aria-99-tab-design" class="fade pb-4 p-4 tab-pane active show">
                            <div class="card mx-auto border border-dark" style="width: 500px;">
                                <div class="card-header mb-4" style="background-color: rgb(27, 164, 210);"><b>Achats</b></div>
                                <div class="container">
                                    
                                        <div class="mb-3 row">
                                            <label for="Libelle" class="col-sm-4 col-form-label form-label" style="padding-left:30px;">Libelle</label>
                                            <div class="col-sm-8 mb-3 mb-lg-0">
                                                <input type="text" class="form-control " placeholder="Libelle" id="libelle"  style="padding-right:30px;" name="libelle">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="Categorie" class="col-sm-4 col-form-label form-label" style="padding-left:30px;">Categorie</label>
                                            <div class="col-sm-8 mb-3 mb-lg-0">
                                                <select id="categoriedrop" class="mb-3" name="nomCategorie">
                                                    <option selected disabled>Select categorie</option>
                                                    
                                                    @foreach ($categories as $categorie)
                                                    <option value="{{ $categorie->id }}" >{{ $categorie->nomCategorie }}</option>
                                                    @endforeach
                                                    <option id="createCategoryOption"><h3><b>Creer Votre Catégorie</b></h3></option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="Prix" class="col-sm-4 col-form-label form-label" style="padding-left:30px;">Prix</label>
                                            <div class="col-sm-8 mb-3 mb-lg-0">
                                                <input type="text" class="form-control " placeholder="Prix d'estimation" id="Prix" name="prix"  style="padding-right:30px;">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="Description" class="col-sm-4 col-form-label form-label" style="padding-left:30px;">Description</label>
                                            <div class="col-sm-8 mb-3 mb-lg-0">
                                                <input type="text" class="form-control " placeholder="Description" id="Description" name="description" style="padding-right:30px;">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="" class="col-sm-4 col-form-label form-label" style="padding-left:30px;">Tva</label>
                                            <div class="col-sm-8 mb-3 mb-lg-0">
                                                <input type="text" class="form-control " placeholder="Tva" id="" name="tva" style="padding-right:30px;">
                                            </div>
                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-round-lg" style="background-color: rgb(27, 164, 210);">Enregistrer</button>
                </div>
             

            </div>
         </form>
        
        </div>
    </div>
</div>
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="myModalDATA"  style="font-family: cursive; color:rgb(27, 164, 210);">Créer Votre Catégorie</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <form method="POST" action="{{route('categorieCh.store')}}">
            @csrf
            <div class="modal-body">
               
                <!-- Contenu du modal -->
                <div class="mb-3 row">
                    <label for="Nom Catégorie" class="col-sm-4 col-form-label form-label" style="padding-left:30px;">Catégorie</label>
                    <div class="col-sm-8 mb-3 mb-lg-0">
                        <input type="text" class="form-control " placeholder="Nom de la Catégorie" id="" name="categorieName"  style="padding-right:30px;">
                    </div>
                </div>
                
                <!-- Ajoutez ici les champs de formulaire ou les éléments nécessaires pour créer une nouvelle catégorie -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#categoriedrop').change(function() {
            var selectedOption = $(this).find('option:selected');
            if (selectedOption.attr('id') === 'createCategoryOption') {
                $('#createCategoryModal').modal('show');
            }
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
