@extends('layouts.app', ['title' => __('Modifier Fournisseur')])


@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="header pb-8 pt-5 pt-lg-5 d-flex align-items-center;" >
    <!-- Mask -->
    <span class="mask bg-gradient-grey "></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-md-12 {{ $class ?? '' }}"> 
            <h1 style="font-family: cursive; color:rgb(27, 140, 210);" >Modifiez les données de votre fournisseur</h1>
            @if (isset($description) && $description)
                <p class="text-white mt-0 mb-5" style="background-color: rgb(59, 145, 215)">{{ $description }}</p>
            @endif
            </div>
        </div>
    </div>
</div>  

<div class="container-fluid mt--7">
    <form action="{{ route('fournisseur.update', ['fournisseur' => $fournisseur->id]) }}" method="POST">
        @csrf
        @method('PUT')
    <div class="row">
        <!-- Première colonne -->
            <div class="col-md-5"> 
                <div class="mb-4">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="{{ $fournisseur->nom }}"
                       >
                </div>
                <div class="mb-4">
                    <label for="email">Adresse e-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $fournisseur->email }}"
                       >
                </div>
                <div class="mb-4">
                    <label for="adresse">Adresse</label>
                    <input type="text" class="form-control" id="adresse" name="adresse" value="{{ $fournisseur->adresse }}"
                       >
                </div>

                <div class="mb-4">
                    <label for="cp">Code postal</label>
                    <input type="text" class="form-control" id="cp" name="cp" value="{{ $fournisseur->cp }}"
                       >
                </div>

               
            </div>

            <!-- Deuxième colonne -->
            <div class="col-md-5">
                <div class="mb-4">
                    <label for="ice">ICE</label>
                    <input type="text" class="form-control" id="ice" name="ice" value="{{ $fournisseur->ice }}"
                      >
                </div>

                <div class="mb-4">
                    <label for="pays">Pays</label>
                    <input type="text" class="form-control" id="pays" name="pays" value="{{ $fournisseur->pays }}"
                      >
                </div>

                <div class="mb-4">
                    <label for="tel">Téléphone</label>
                    <input type="tel" class="form-control" id="tel" name="tel" value="{{ $fournisseur->tel }}"
                      >
                </div>

                <div class="mb-4">
                    <label for="ville">Ville</label>
                    <input type="text" class="form-control" id="ville" name="ville" value="{{ $fournisseur->ville }}"
                      >
                </div>
        </div>
    </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 30px;">Enregistrer</button>
    </form>
</div>

@endsection