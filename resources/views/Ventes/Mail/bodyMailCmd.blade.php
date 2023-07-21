@extends('layouts.app')

@section('content')

@include('users.partials.BodyMailHeader', [
    'title' => __('Bienvenue') . ' '. auth()->user()->name,
])

<div class="d-flex justify-content-center align-items-center">
    <div class="col-xl-6">
        <div class="card bg-secondary shadow">
            <div class="bg-blu" style="padding: 0rem 1.5rem">
                <div class="row align-items-center">
                    <h3 class="mb-0" style="font-family: sans-serif; color: white">{{ __('Informations') }}</h3>
                </div>
            </div>
            <div class="card cards card-2 text-center">
                <div class="card-body">
                    <form action="{{route('sendMailCmd')}}" method="GET">
                        <div class="form-group row">
                          <?php $client = session('client'); ?>
                          <?php $BonCom = session('BonCom'); ?>
                            <label for="sujet" class="col-auto col-form-label">Sujet :</label>
                            <div class="col">
                              <input type="text" class="form-control" id="" placeholder="Sujet" name="subject" value="MGA Invoice Notify">
                              <input type="hidden" class="form-control" id="" placeholder="destinataire" name="destin" value="{{ $client->email }}">
                              <input type="hidden" class="form-control" id="" placeholder="idfacture" name="BonComid" value="{{$BonCom->id }}">
                              <input type="hidden" class="form-control" id="" placeholder="destinataire" name="clientname" value="{{ $client->nom . ' ' . $client->prenom }}">


                            </div>
                          </div>
                       
                          <div class="form-group row">
                            <label for="body" class="col-auto col-form-label">Texte :</label>
                            <div class="col">
                              <textarea type="text" class="form-control" id="" placeholder="message à inclure" name="body">Bonjour,Veuillez trouver ci-joint votre Bon de Commande de MGA</textarea>
                            </div>
                          </div>
                          <button type="submit"  class="btn btn-primary  btn-block mb-3" style="background-color: rgb(27, 164, 210);">Valider</button>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
@include('layouts.footers.auth')

@endsection
