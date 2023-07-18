@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Bienvenue') . ' '. auth()->user()->name,     
    ])   
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-3 order-xl-2 mb-5 mb-xl-2">
                <div class="card card-profile shadow">
                  <div class="card-body pt-0 pt-md-">
                    <div class="d-grid gap-2">
                      <button class="btn btn-primary mb-2 mt-4" type="button" style="Calibri Light:  Verdana, sans-serif; ">SUPPRIMER  </button>
                      <button class="btn btn-secondary mb-2" type="button" style="Calibri Light:  Verdana, sans-serif;">ENVOYER  </button>
                      <form method="POST" action="{{ route('devis.telecharger') }}">
                        @csrf
                        <button class="btn btn-primary mb-2 mt-4" type="submit" style="font-family: 'Calibri Light', Verdana, sans-serif;">Télécharger</button>
                      </form>
                      
                    </form>
                    </div>
                  </div>
                </div>
              </div>
              
              
            <div class="col-xl-9 order-xl-0" >
                <div class="card bg-secondary shadow" >
                    <div class=" bg-blu" style="padding: 0rem 1.5rem" >
                        <div class="row align-items-center" >
                            <h3 class="mb-0" style="font-family: sans-serif; color: white">{{ __('devis') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-white border-0">
                        <div>
                            <img src="{{ asset('argon') }}/img/brand/facture.png" class="upload-icon">
                            <input type="file" id="photo" class="hidden">
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-6" style="font-size: 14px">
                                <b-form-textarea name="" id="" cols="30" no-resize readonly data-bs-toggle="modal"
                                    data-bs-target="#myModal" class="custom-textarea">
                                    Nom <br>
                                    Ville CodePostale <br>
                                    RIB :08783939383<br>
                                    tel:0674321490
                                </b-form-textarea>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="input-group" style="width: 280px">
                                    <img src="{{ asset('argon') }}/img/brand/fleche.png" alt="" style="width: 40px;">
                                    <h4 style="font-family: cursive; color:rgb(41, 136, 220);">Choisissez ou créez un client</h4>
                                    <div class="input-group"  >
                                        <select class="form-select" id="client-select" onchange="handleClientSelectChange(this)">
                                            <option value="" disabled selected>Choisissez ou créez un client</option>
                                            @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">
                                                {{ $client->nom }} {{ $client->prenom }}
                                            </option>
                                        @endforeach
                                            <option value="add-client" style="font-family: cursive; color:rgb(41, 136, 220);font-size=12px;">Creer un nouveau client</option>
                                        </select>
                                </button>
                                </div>
                            </div>
                            </div> 
                        </div>
                       
                        <div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title"  style="font-family: cursive; color:rgb(27, 164, 210);">Crrer un nouveau client</h2>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('client.store') }}">
                                            @csrf
                                        <!-- Champs de saisie pour le nouveau client -->
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <input type="text" class="form-control" id="newClientICE" name="ice" placeholder="ICE">
                                                @error('ice')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="text" class="form-control" id="newClientIF" name="if" placeholder="Identifiant fiscale*">
                                                @error('if')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="text" class="form-control" id="newClientName" name="nom" placeholder="Nom*">
                                                
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="text" class="form-control" id="newClientPreName" name="prenom" placeholder="Prenom*">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="text" class="form-control" id="newClientAdresse" name="adresse" placeholder="Adresse*">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="text" class="form-control" id="newClientVille" name="ville" placeholder="Ville*">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="text" class="form-control" id="newClientCP" name="cp" placeholder="CP*">
                                                @error('cp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <select class="form-select" id="NewClientPays" name="Pays" style="color:rgb(95, 94, 94)">
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country['name'] }}" @if ($country['name'] === 'Morocco') selected @endif>{{ $country['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="email" class="form-control" id="newClientAdresseEMail" name="email" placeholder="Adresse e-mail*" required>                                               
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="text" class="form-control" id="newClientTel" name="tel" placeholder="Telephone">
                                                @error('tel')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-primary" id="btnEnregistrer" >Enregistrer</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title"  style="font-family: cursive; color:rgb(27, 164, 210);">Crrer un nouveau client</h2>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('client.update', $client->id) }}">
                                            @csrf
                                            @method('PUT')
                                        <!-- Champs de saisie pour le nouveau client -->
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <input type="text" class="form-control" id="editClientICE" name="ice" placeholder="ICE" value="{{ $client->ice }}">
                                                @error('ice')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="text" class="form-control" id="editClientCP" name="if" placeholder="Identifiant fiscale*" value="{{ $client->if }}">
                                                @error('if')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <input type="hidden" name="client_id" value="{{ $client->id }}">
                                            <div class="col-md-6 mb-3">
                                                <input type="text" class="form-control" id="editClientName" name="nom" placeholder="Nom*" value="{{ $client->nom }}">
                                                
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="text" class="form-control" id="editClientPrename" name="prenom" placeholder="Prenom*" value="{{ $client->prenom }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="text" class="form-control" id="editClientAdresse" name="adresse" placeholder="Adresse*" value="{{ $client->adresse }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="text" class="form-control" id="editClientVille" name="ville" placeholder="Ville*" value="{{ $client->ville }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="text" class="form-control" id="editClientCP" name="cp" placeholder="CP*" value="{{ $client->cp }}">
                                                @error('cp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <select class="form-select" id="editClientPays" name="Pays" style="color:rgb(95, 94, 94)">
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country['name'] }}" @if ($country['name'] === 'Morocco') selected @endif>{{ $country['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="text" class="form-control" id="editClientAdresseEmail" name="email" placeholder="Adresse e-mail*" value="{{ $client->email }}">
                                                @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="text" class="form-control" id="editClientTel" name="tel" placeholder="Telephone" value="{{ $client->tel }}">
                                                @error('tel')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-primary" id="btnEnregistrer" >Enregistrer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title" id="myModalDATA"  style="font-family: cursive; color:rgb(27, 164, 210);">mettez vos Cordonnées à jour</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Champs de saisie -->
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
            
                                                <input type="text" class="form-control" id="inputNom" placeholder="Nom">
                                            </div>
                                            <div class="col-md-6 mb-3">
            
                                                <input type="text" class="form-control" id="inputICE" placeholder="ICE">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
            
                                                <input type="text" class="form-control" id="inputAdresse" placeholder="Adresse">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
            
                                                <input type="text" class="form-control" id="inputCP" placeholder="CP*">
                                            </div>
                                            <div class="col-md-4 mb-3">
            
                                                <input type="text" class="form-control" id="inputVille" placeholder="Ville*">
                                            </div>
                                            <div class="col-md-4 mb-3">
            
                                                <input type="text" class="form-control" id="inputTelephone" placeholder="Telephone*">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Autres champs de saisie -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        <button type="button" class="btn btn-primary" >Enregistrer</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                
                        
                        <br>
                        <div class="row">
                            <div class="col-md-6" style="font-size: 14px">
                                <b-form-textarea name="" id="" cols="30" no-resize readonly data-bs-toggle="modal"
                                    data-bs-target="#myModale" class="custom-textarea">
                                    <b>Facture</b> <br>
                                    Date: {{ \Carbon\Carbon::today()->format('d-m-Y') }}<br>
                                    Echéance :{{ \Carbon\Carbon::today()->format('d-m-Y') }}<br>
                                </b-form-textarea>
                            </div>
             
                        </div>
                        <div class="modal fade" id="myModale" tabindex="-1" aria-labelledby="myModalLabele" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title" id="myModalInfoEntreprise"  style="font-family: cursive; color:rgb(27, 164, 210);">modifier Date de la Facture</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Champs de saisie -->
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
            
                                                <label for="date">Date :</label>
                                                <input type="date" id="date" name="date" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="date">Echéance :</label>
                                                <input type="date" id="date" name="date" class="form-control">
                                            </div>
                                        </div>
                                      
                                    </div>
                                    <!-- Autres champs de saisie -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        <button type="button" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- facture montant bow -->
                        <br>
                        <br>
                        
                    
                            <!-- Bouton pour ouvrir le modal -->

                            <!-- Modal -->
                            <table class="table" data-bs-toggle="modal" data-bs-target="#myModaltab">
                                <thead>
                                  <tr>
                                    <th scope="col"><b>RÉFÉRENCE</b></th>
                                    <th scope="col"><b>LIBELLÉ	</b></th>
                                    <th scope="col"><b>PRIX</b></th>
                                    <th scope="col"><b>REMISE</b></th>
                                    <th scope="col"><b>TVA</b></th>
                                    <th scope="col"><b>DESCRIPTION</b></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr class="data-row">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                  </tr>
                                  <tr class="data-row">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                  </tr>
                                </tbody>
                              </table>
                              
                              <!-- Bouton pour ouvrir le modal -->
                              
                              <!-- Modal -->
                              <div class="modal fade bd-example-modal-lg" id="myModaltab" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h2 class="modal-title" id="myModaltab" style="font-family: cursive; color:rgb(27, 164, 210);">Ajouter ou modifier des services</h2>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <table class="table">
                                        <thead>
                                          <tr>
                                            <th scope="col">Référence</th>
                                            <th scope="col">Libellé</th>
                                            <th scope="col">Prix</th>
                                            <th scope="col">Remise</th>
                                            <th scope="col">TVA</th>
                                            <th scope="col">Description</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td><input type="text" class="form-control" id="inputReference"></td>
                                            <td><input type="text" class="form-control" id="inputLibelle"></td>
                                            <td><input type="text" class="form-control" id="inputPrix"></td>
                                            <td><input type="text" class="form-control" id="inputRemise"></td>
                                            <td><input type="text" class="form-control" id="inputTVA"></td>
                                            <td><textarea type="text" class="form-control" id="inputDescription" rows="2"></textarea></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                      <button type="button" class="btn btn-primary" id="btnEnregistrer">Enregistrer</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            <br>
                            <br>
                            <!-- modal montant -->
                            <div class="row justify-content-end">
                                <div class="col-md-5 ml-auto" >
                                    <table data-bs-toggle="modal" data-bs-target="#myModalMT">
                                    <thead>
                                    <tr> 
                                            <td >Remise globale:</td>
                                            <td style="padding-left: 20px;">20DH</td>
                                        </tr>
                                        <tr> <td>Total Htva:</td> 
                                                <td style="padding-left: 20px;">18DH</td> 
                                            </tr>
                                        <tr>  <td>TvA </td>
                                                <td style="padding-left: 20px;">20%</td>
                                            </tr>
                                            <tr>
                                                <br>
                                            </tr>
                                            <tr>  <th>Total </th>
                                                <td style="padding-left: 20px;">200DH</td>
                                            </tr>
                                    
                                    </thead>
                                
                                    </table>

                                
                                    <!-- Dropdown liste ici -->

                                </div>
                            </div>
                            <div class="modal fade bd-example-modal-lg" id="myModalMT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="modal-title" id="myModalMT"  style="font-family: cursive; color:rgb(27, 164, 210);">modifier Remise</h2>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table">
                                                
                                                <tbody>
                                                    <tr>
                                                        <td><h2>Remise</h2></td>
                                                        <td><input type="text" class="form-control"></td>
                                                    
                                                        
                                                            
                                                    </tr>
                                                    <!-- Ajoutez d'autres lignes ici -->
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="button" class="btn btn-primary">Enregistrer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>

                            <div>
                                <table data-bs-toggle="modal" data-bs-target="#myModalData" >
                                    <tr>
                                    <td><h5><b>RIB:</b>12346789</h5></td>
                                    <td><h5>| <b>swift:</b>12345678</h5></td> 
                                    <td><H5>|<b>RC:</b>12345679</H5></td>
                                    <td><H5>|<b>pattent:</b>06445567654</H5></td>
                                    <td><H5>|<b>IF:</b>5643976426</H5></td>
                                
                                    </tr>
                                </table>
                            </div>
                            <div class="modal fade bd-example-modal-lg" id="myModalData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="modal-title" id="myModalDATA"  style="font-family: cursive; color:rgb(27, 164, 210);">mettez vos données à jour</h2>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                            
                                                    <input type="text" class="form-control" id="inputNom" placeholder="RIB">
                                                </div>
                                                <div class="col-md-2 mb-3">
                            
                                                    <input type="text" class="form-control" id="inputPays" placeholder="SWIFT">
                                                </div>
                                                <div class="col-md-2 mb-3">
                            
                                                    <input type="text" class="form-control" id="inputNom" placeholder="RC">
                                                </div>
                                                <div class="col-md-2 mb-3">
                            
                                                    <input type="text" class="form-control" id="inputPays" placeholder="Pattent">
                                                </div>
                                                <div class="col-md-3 mb-3">
                            
                                                    <input type="text" class="form-control" id="inputNom" placeholder="IF">
                                                </div>
                                              
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="button" class="btn btn-primary">Enregistrer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <table>
                                    <tr>
                                        <h5>Veuillez payez le montant de 200dh avant le 28/07/2023</h5>
                                    </tr>
                                </table>
                            </div>
            
                            <div>
                                <br>
                                <br>
                                <br>
                                Merci de votre Confiance !
                                <br>
                                <br>
                                <br>
                            </div>
                            
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ asset('argon') }}/img/brand/MGAAAA.png" alt="" style="width: 50px; margin-left: 10px;">
                                    
            
                                </div>
                                <div class="col-md-4 ml-auto">
                                    <div class="d-flex align-items-center">
                                        <h5>Envoyé par </h5>
                                        <img src="{{ asset('argon') }}/img/brand/MGAAAA.png" alt="" style="width: 50px; margin-left: 10px;">
                                    </div>
                                    <hr class="horizontal-line">
                                </div>
                            </div>


                    </form>
                </div>
            </div>
            
        </div>
        
       
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
    function handleClientSelectChange(selectElement) {
    if (selectElement.value === 'add-client') {
        $('#addClientModal').modal('show');
        selectElement.selectedIndex = 0;
    } else {
        var clientId = selectElement.value;
        console.log(clientId);
        var url = '/devis/clients/' + clientId;

        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                console.log(response); 
                var clientInfo = '<div class="client-info">' +
                    '<p>Nom: ' + response.nom + '</p>' +
                    '<p>Prénom: ' + response.prenom + '</p>' +
                    '<p>ICE: ' + response.ice + '</p>' +
                    '<p>Adresse: ' + response.adresse + '</p>' +
                    '<p>CP: ' + response.cp + '</p>' +
                    '</div>';
                
                $(selectElement).replaceWith(clientInfo);
                $(document).on('click', '.client-info', 
                function() {
                    var nom = response.nom;
                    var prenom = response.prenom;
                    var ice = response.ice;
                    var adresse = response.adresse;
                    var cp = response.cp;
                    $('#editClientModal').modal('show');
                    $('#editClientName').val(nom);
                    $('#editClientPrenom').val(prenom);
                    $('#editClientICE').val(ice);
                    $('#editClientAdresse').val(adresse);
                    $('#editClientCP').val(cp);

    
                selectElement.selectedIndex = 0;
                });
            },
            error: function(xhr, status, error) {
                console.log(error);
                $('.client-info').html('<p>Une erreur s\'est produite lors de la récupération des informations du client.</p>');
            }
        });
    }
}
    </script>
    <br>
    @include('layouts.footers.auth')
@endsection
