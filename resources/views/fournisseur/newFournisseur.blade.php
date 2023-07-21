@extends('layouts.app', ['title' => __('User Profile')])

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
            <h1 style="font-family: cursive; color:rgb(27, 140, 210);" >Créer un fournisseur</h1>
            @if (isset($description) && $description)
                <p class="text-white mt-0 mb-5" style="background-color: rgb(59, 145, 215)">{{ $description }}</p>
            @endif
            </div>
        </div>
    </div>
</div>  


<div class="container-fluid mt--7">
    <form method="POST" action="{{ route('fournisseur.store') }}">
        @csrf
        <div class="row">
            <!-- Première colonne -->
            <div class="col-md-5">
                <div class="mb-4">
                    <label for="inputICE" style="font-size: 13px;">ICE </label>
                    <input type="text" id="newClientICE" name="ice" class="form-control shadow">
                </div>
                <div class="mb-4">
                    <label for="inputNom" style="font-size: 13px;">Nom* </label>
                    <input type="text" id="newClientName" name="nom" class="form-control shadow">
                </div>
                <div class="mb-4">
                    <label for="inputAdresse" style="font-size: 13px;">Adresse* </label>
                    <input type="text" id="newClientAdresse" name="adresse" class="form-control shadow">
                </div>
                <div class="mb-4">
                    <label for="inputCP" style="font-size: 13px;">Code Postal* </label>
                    <input type="text" id="newClientCP" name="cp" class="form-control shadow">
                </div>
            </div>

            <!-- Deuxième colonne -->
            <div class="col-md-5">
                <div class="mb-4">
                    <label for="inputEmail" style="font-size: 13px;">Adresse e-mail* </label>
                    <input type="text" id="newClientAdresseEMail" name="email" class="form-control shadow">
                </div>
                <div class="mb-4">
                    <label for="inputVille" style="font-size: 13px;">Ville*</label>
                    <input type="text" id="newClientAdresse" name="ville" class="form-control shadow">
                </div>
                <div class="mb-4">
                    <label for="inputEmail" style="font-size: 13px;">Pays </label>
                    <select class="form-select" id="NewClientPays" name="Pays" style="color:rgb(95, 94, 94) ;height: 49px;">
                        @foreach ($countries as $country)
                            <option value="{{ $country['name'] }}" @if ($country['name'] === 'Morocco') selected @endif >{{ $country['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="inputTelephone" style="font-size: 13px;">Numéro de téléphone </label>
                    <input type="text" id="newClientTel" name="tel" class="form-control shadow">
                </div>
               
            </div>
             <div class="mb-4">
                    <button type="submit" class="btn btn-primary" id="btnEnregistrer" style="margin-top: 30px;">Enregistrer</button>
                </div>
        </div>
    </form>
</div>



<br>
@include('layouts.footers.auth')
@endsection
