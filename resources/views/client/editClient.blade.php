@extends('layouts.app', ['title' => __('Modifier Client')])

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
            <h1 style="font-family: cursive; color:rgb(27, 140, 210);" >Modifiez les données de votre client</h1>
            @if (isset($description) && $description)
                <p class="text-white mt-0 mb-5" style="background-color: rgb(59, 145, 215)">{{ $description }}</p>
            @endif
            </div>
        </div>
    </div>
</div>  

<div class="container-fluid mt--7">
    <div class="row">
        <!-- Première colonne -->
        <div class="col-md-5">
            <form action="{{ route('client.update', ['client' => $client->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="{{ $client->nom }}"
                        >
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $client->prenom }}"
                        >
                </div>

                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <input type="text" class="form-control" id="adresse" name="adresse" value="{{ $client->adresse }}"
                        >
                </div>

                <div class="form-group">
                    <label for="cp">Code postal</label>
                    <input type="text" class="form-control" id="cp" name="cp" value="{{ $client->cp }}"
                        >
                </div>
                <div class="form-group">
                    <label for="tel">Téléphone</label>
                    <input type="tel" class="form-control" id="tel" name="tel" value="{{ $client->tel }}"
                        >
                </div>
            </div>

            <!-- Deuxième colonne -->
            <div class="col-md-5">
                <div class="form-group">
                    <label for="email">Adresse e-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $client->email }}"
                        >
                </div>

                <div class="form-group">
                    <label for="ice">ICE</label>
                    <input type="text" class="form-control" id="ice" name="ice" value="{{ $client->ice }}"
                        >
                </div>
                
                <div class="form-group">
                    <label for="if">IF</label>
                    <input type="text" class="form-control" id="if" name="if" value="{{ $client->if }}"
                        >
                </div>

                <div class="form-group">
                    <label for="pays">Pays</label>
                    <input type="text" class="form-control" id="pays" name="pays" value="{{ $client->pays }}"
                        >
                </div>

               
                
                <div class="form-group">
                    <label for="ville">Ville</label>
                    <input type="text" class="form-control" id="ville" name="ville" value="{{ $client->ville }}"
                        >
                </div>

               
        </div> 
       
    </div> 
    <button type="submit" class="btn btn-primary" style="margin-top: 30px;">Enregistrer</button>
        </form>
</div>

@endsection
