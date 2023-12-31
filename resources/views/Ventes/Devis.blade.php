@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
<div class="header pb-8 pt-5 pt-lg-5 d-flex align-items-center;" >
    <!-- Mask -->
    <span class="mask bg-gradient-grey "></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-md-12 {{ $class ?? '' }}">
             
            <h1 style="font-family: cursive; color:rgb(27, 164, 210);" >Créer votre Devis </h1>
                
            </div>
        </div>
    </div>
</div>  

 <div class="container-fluid mt--8">
     <form action="{{route('devis.store')}}" method="post">
        @csrf 
            <div class="row">
                <div class="col-xl-2 order-xl-2 mb-5 mb-xl-2">
                    <div class="card-body pt-0 pt-md-1">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex flex-column justify-content-center align-items-stretch mt-md-5" style="position: fixed;" >
                                    <button type="submit" class="btn btn-primary  btn-block mb-3" style="background-color: rgb(27, 164, 210);"disabled id="btnEnvoyer">
                                        <i class="fas fa-paper-plane"></i> Envoyer</button>
                                    <button type="submit" class="btn btn-primary btn-block mb-3" style="background-color: rgb(27, 164, 210);" formaction="{{ route('devis.telecharger') }}" formmethod="POST" disabled id="btnTelecharger">
                                        <i class="fas fa-download"></i> Télécharger
                                    </button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            <div class="col-xl-10 order-xl-0">
                <div class="card bg-secondary shadow">
                    <div class=" bg-blu" style="padding: 0rem 1.5rem">
                        <div class="row align-items-center">
                            <h3 class="mb-0" style="font-family: sans-serif; color: white">{{ __('Devis') }}</h3>
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
                            <div class="col-md-6">
                                @foreach ($entreprises as $entreprise)
                                <b-form-textarea name="" id="" cols="30" no-resize readonly data-bs-toggle="modal"
                                    data-bs-target="#myModal" class="custom-textarea">
                                   <b style="font-size: 120%"> {{$entreprise->Nom_Commercial}}</b><br>
                                   {{$entreprise->Pays}} <br>
                                   {{$entreprise->CP}} {{$entreprise->Ville}} <br>
                                   {{$entreprise->ICE}} <br>
                                   {{$entreprise->Telephone}} <br>
                                   
                                </b-form-textarea>
                                @endforeach
                            </div>
                   
                            <input type="hidden"  name="date" class="dateValuee">
                            <input  type="hidden"  name="echeance" class="echeanceValuee">
                            <input type="hidden" class="remisevaluee" name="remise">
                            <input type="hidden" class="TVAValuee" name="TvaV">
                            <input type="hidden" class="MTValuee" name="montantHtva">
                            <input type="hidden" class="prixtotalValuee" name="montantTotal">


                            <div class="col-md-6">

                                <div class="input-group" style="width: 280px">
                                    <img src="{{ asset('argon') }}/img/brand/fleche.png" alt="" style="width: 40px;">
                                    <h4 style="font-family: cursive; color:rgb(41, 136, 220);">Choisissez ou créez un client</h4>
                                    <div class="input-group"  >
                                        <select class="form-select" onchange="handleClientSelectChange(this)">
                                            <option value="" disabled selected>Choisissez ou créez un client</option>
                                            @foreach ($clients as $item)
                                            <option value="{{$item->id}}">{{$item->nom}} {{$item->prenom}}</option>

                                            @endforeach
                                            <option value="add-client" style="font-family: cursive; color:rgb(41, 136, 220);font-size=12px;">Creer un nouveau client</option>

                                        </select>
                                    </div>
                                </div>
                                
                                
                            </div>
 </form>   
                    
                            
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
                                        <form action="{{ route('entreprise.update', $entreprise->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <!-- Champs de saisie -->
                                                    <div class="row">
            
                                                    <div class="col-md-6 mb-3">
                    
                                                        <input type="text" class="form-control"  placeholder="Nom_Commercial" name="Nom_Commercial" value="{{$entreprise->Nom_Commercial}}">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                    
                                                        <input type="text" class="form-control"  placeholder="ICE" name="ICE" value="{{$entreprise->ICE}}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                    
                                                        <input type="text" class="form-control"  placeholder="Pays" name="Pays" value="{{$entreprise->Pays}}">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                    
                                                        <input type="text" class="form-control"  placeholder="Adresse" value="{{$entreprise->Ville}}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 mb-3">
                    
                                                        <input type="text" class="form-control"  placeholder="CP" name="CP" value="{{$entreprise->CP}}">
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                    
                                                        <input type="text" class="form-control"  placeholder="Ville" name="Ville" value="{{$entreprise->Ville}}"  >
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                    
                                                        <input type="text" class="form-control"  placeholder="Telephone" name="Telephone" value="{{$entreprise->Telephone}}" >
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                </div>
                                        </form>
                                    </div>
                                    
                                    <!-- Autres champs de saisie -->
                                    
                                </div>
                            </div>
                        </div>

                        <!-- facture box-->
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                   
                                
                                <b-form-textarea name="" id="textdate" cols="30" no-resize readonly data-bs-toggle="modal"
                                    data-bs-target="#myModale" class="custom-textarea">
                                    <b style="color:rgb(27, 164, 210)" >Devis</b> <br>
                                    Date: <span id="dateValue" name="date" class="dateValue" contenteditable="true"></span> <br>
                                    Echéance: <span id="echeanceValue" name="echeance" class="echeanceValue" contenteditable="true"></span> <br>
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
                    
                                                        <input type="date" class="form-control" id="inputDate" placeholder="Date">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                    
                                                        <input type="date" class="form-control" id="inputEcheance" placeholder="Echeance">
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <!-- Autres champs de saisie -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                <button type="button"class="btn btn-primary" style="background-color: rgb(27, 164, 210);" onclick="enregistrer()">Enregistrer</button>
                                            </div>
                                            
                                </div>
                            </div>
                        </div>

                        <!-- facture montant bow -->
                        <br>
                        <br>
                        <td><input type="hidden" id="LibelleService"  placeholder="Rmse" class="champ-ligne" style="width: 60px" ></td>
                                <td><input type="hidden" id="LibelleCategorie"  placeholder="Rmse" class="champ-ligne" style="width: 60px" ></td>
                                <td><input type="hidden" id="LibelleService2"  placeholder="Rmse" class="champ-ligne" style="width: 60px" ></td>
                                <td><input type="hidden" id="tableauIdsServicesInput"  name="tab" placeholder="Rmse" class="champ-ligne" style="width: 60px" ></td>

                                <table class="table " data-bs-toggle="modal" data-bs-target="#myModaltab">
                            <thead  >
                              <tr  >
                                
                                <th scope="col">Categorie</th>
                                <th scope="col">Libellé</th>
                                
                                <th scope="col">Prix</th>
                                <th scope="col">TVA</th>
                               
                                <th scope="col">Description</th>
                              </tr>
                            </thead>
                           
                            <tbody id="resultat">
                                <tr>
                                
                                </tr>
                                
                              
                           
                              
                            </tbody>
                           
                            
                            
                         
                         </table>
                            <!-- Bouton pour ouvrir le modal -->
                           
                            <!-- Modal -->
                      
                            <div class="modal fade bd-example-modal-lg " id="myModaltab" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg " style="max-width:1000px;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="modal-title" id="myModaltab"  style="font-family: cursive; color:rgb(27, 164, 210);">Ajouter ou modifier des services</h2>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                       
                                                <div class="modal-body" >
                                                   
                                                     <div class="tableau-container"> 

                                                   
                                                        <table class=" table" id="tableServices">
                                                        <thead>
                                                            
                                                            <tr>
                                                            
                                                                <th scope="col">Categorie</th>
                                                                <th scope="col">Libellé</th>
                                                                
                                                                <th scope="col">Prix</th>
                                                                <th scope="col">TVA</th>
                                                                <th scope="col">Description</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        
                                                            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
                                                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                                                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                                            
                                                                <script>
                                                                 // script js -->
                                                                    function getServiceInfo() {
                                                                        var selectedService = document.getElementById("service").value;
                                                                        if (selectedService) {
                                                                            // Effectuez une requête AJAX pour récupérer les informations du service
                                                                            var serviceUrl = "{{ route('services.info', ['id' => '__ID__']) }}";
                                                                            var apiUrl = serviceUrl.replace('__ID__', selectedService);
                                                                            console.log(apiUrl);
                                                                            axios.get(apiUrl)
                                                                            
                                                                                .then(function(response) {
                                                                                    var service = response.data;
                                                                    
                                                                                    // Mettez à jour les champs avec les informations du service
                                                                                    document.getElementById("LibelleService").value = service.Libelle;
                                                                                

                                                                                    document.getElementById("prixService").value = service.Prix;
                                                                                    document.getElementById("remiseService").value = service.Tva;
                                                                                    document.getElementById("description").value = service.Description;
                                                                                    document.getElementById("service_id").value = service.id;
                                                                                    // Mettez à jour d'autres champs selon vos besoins
                                                                    
                                                                                })
                                                                                .catch(function(error) {
                                                                                    console.log(error);
                                                                                });
                                                                        } else {
                                                                            // Réinitialisez les champs si aucun service n'est sélectionné
                                                                            document.getElementById("service_id").value = "";
                                                                            document.getElementById("prixService").value = "";
                                                                            document.getElementById("remiseService").value = "";
                                                                            document.getElementById("description").value = "";
                                                                        
                                                                            // Réinitialisez d'autres champs selon vos besoins
                                                                        }
                                                                        
                                                                    }
                                                                </script>
                                                            
                                                               <!-- script jquery -->
                                                             <script type="text/javascript">
                                                                $(document).ready(function () {
                                                                    $('#categorie').on('change', function () {
                                                                        var categorieId = this.value;
                                                                        var url = '{{ route('getServices') }}?IdCategorie=' + categorieId;
                                                                        console.log(url);

                                                                        $('#service').html('');
                                                                        $.ajax({
                                                                            url: url,

                                                                            type: 'get',
                                                                            success: function (res) {
                                                                                $('#service').html('<option value="">Select service</option>');
                                                                                $.each(res, function (key, value) {
                                                                                    $('#service').append('<option value="' + value
                                                                                        .id + '">' + value.Libelle + '</option>');
                                                                                });
                                                                            
                                                                            }
                                                                        });
                                                                    });
                                                                
                                                                });
                                                             </script> 
                                                           
                                                            <script type="text/javascript">
                                                                 $(document).ready(function () 
                                                                 {
                                                                    $('#categorie').on('change', function () {
                                                                        var categorieId = this.value;
                                                                        $('#servicee').html('');
                                                                        $.ajax({
                                                                            url: '{{ route('getServices') }}?IdCategorie='+categorieId,
                                                                            type: 'get',
                                                                            success: function (res) {
                                                                                $('#servicee').html('<option value="">Select service</option>');
                                                                                $.each(res, function (key, value) {
                                                                                    $('#servicee').append('<option value="' + value
                                                                                        .id + '">' + value.Libelle + '</option>');
                                                                                });
                                                                            
                                                                            }
                                                                        });
                                                                        getServiceInfo();
                                                                    });
                                                                
                                                                 });
                                                            </script>
                                                                   
                                                        
                                                             <tr class="ligne-modele">
                                                               
                                                                    <td>
                                                                        <select id="categorie" class="mb-3 categorie  champ-ligne categorie-dropdown" >
                                                                            <option selected disabled>Select categorie</option>
                                                                            @foreach ($categories as $categorie)
                                                                            <option value="{{ $categorie->id }}"  data-info="{{ json_encode($categorie) }}">{{ $categorie->Nom_Categorie }}</option>
                                                                            
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                
                                                                    <td><select  id="service" onchange="getServiceInfo()" class="mb-3 service champ-ligne"></select></td>
                                                                    <td> <input type="text" id="prixService"  placeholder="Prix" class="prix-service champ-ligne" style="width: 60px" name="Prix" ></td>
                                                                    <td ><input type="text" id="remiseService"  placeholder="TVA" class="remise-service champ-ligne" style="width: 60px" name="Tva" ></td>
                                                                    <td><textarea  id="description"  rows="2" name="Description" class="description-service champ-ligne"></textarea></td>
                                                                    <input type="hidden" id="service_id" name="id" class="service-id">

                                                                    
                                                             </tr>
                                                            
                                                            <!-- Ajoutez d'autres lignes ici -->
                                                        </tbody>
                                                    </table>
                                                    <script>
                                                        document.getElementById('categorie').addEventListener('change', function()
                                                         {
                                                            var selectedOption = this.options[this.selectedIndex];
                                                            var categoryInfo = JSON.parse(selectedOption.getAttribute('data-info'));

                                                            // Utilisez les informations de la catégorie sélectionnée comme vous le souhaitez
                                                            console.log(categoryInfo);
                                                            // Vous pouvez mettre à jour d'autres éléments de la vue avec les informations récupérées

                                                            // Exemple de requête AJAX pour obtenir des informations supplémentaires du serveur
                                                            axios.get('/categories/' + categoryInfo.id)
                                                                .then(function(response) {
                                                                    var additionalInfo = response.data;
                                                                    document.getElementById("LibelleCategorie").value=additionalInfo.Nom_Categorie;

                                                                    // Utilisez les informations supplémentaires comme vous le souhaitez
                                                                    console.log(additionalInfo);
                                                                    // Vous pouvez mettre à jour d'autres éléments de la vue avec les informations supplémentaires
                                                                })
                                                                .catch(function(error) {
                                                                    console.log(error);
                                                                });
                                                        });

                                                    </script>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                    <td> <button type="button" class="btn btn-primary" id="btnEnregistrer" onclick="enregistrerService()" >Enregistrer</button></td>
                                                    <td> <button type="button" class="btn btn-primary" id="btnEnregistrer" onclick="supprimerDerniereLigne()" >annuler</button></td>
                                                  
                                                    <!-- <button type="button" class="btn btn-primary"  onclick="enregistrerService()">Enregistrer</button> -->
                                                   <!-- <button id="btnAjouter" onclick="ajouterLignee()" disabled>Ajouter</button> -->

                                                </div>
                                                 
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
                                            <td id="prcRemise">Remise globale:</td>
                                            <td style="padding-left: 20px;" id="remiselabel" contenteditable="true"></td>
                                        </tr>
                                        <tr> <td>Total HTVA</td> 
                                                <td style="padding-left: 20px;" id="thva"></td> 
                                            </tr>
                                        <tr>  <td id="labelTVA">TvA </td>
                                                <td style="padding-left: 20px;" id="tvaCalcule">20%</td>
                                            </tr>
                                            <tr>
                                                <br>
                                            </tr>
                                            <tr>  <th>Total </th>
                                                <th style="padding-left: 20px;" id="montant" class="montant" contenteditable="true"></th>
                                            </tr>
                                    
                                    </thead>
                                
                                    </table>

                                
                                   

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
                                                        <td ><h2>Remise</h2></td>
                                                        <td><input type="text" class="form-control" id="remisevalue" ></td>
                                                    
                                                        
                                                            
                                                    </tr>
                                                    <!-- Ajoutez d'autres lignes ici -->
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="button" class="btn btn-primary" onclick="enregistrerRemise()">Enregistrer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>

                            <div>
                                @foreach($entreprises as $entreprise)
                             <table data-bs-toggle="modal" data-bs-target="#sw" >
                                <tr>
                                    <td><h5><b>RIB:</b>12346789</h5></td>
                                    <td><H5>|<b>pattent:</b>{{$entreprise->Patente}}</H5></td>
                                    <td><H5>|<b>IF:</b>{{$entreprise->IF}}</H5></td>
                                
                                </tr>
                             </table>
                             @endforeach
                            </div>
                            <form action="{{ route('DATA.update', $entreprise->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                            <div class="modal fade bd-example-modal-lg" id="sw" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="modal-title" id="edit"  style="font-family: cursive; color:rgb(27, 164, 210);">mettez vos données à jour</h2>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                            
                                                    <input type="text" class="form-control" id="inputRIB" placeholder="RIB" name="">
                                                </div>
                                               
                                                <div class="col-md-6 mb-3">
                            
                                                    <input type="text" class="form-control" id="inputPays" placeholder="Patente" name="Patente" value="{{$entreprise->Patente}}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                            
                                                    <input type="text" class="form-control" id="inputNom" placeholder="IF" name="IF" value="{{$entreprise->IF}}">
                                                </div>
                                              
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>

                            <div class="lig">
                                <table>
                                    <tr>
                                        <h5 id="mt">Veuillez payez le montant de</h5>
                                        <h5 id="Echec"></h5>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="modal-title"  style="font-family: cursive; color:rgb(27, 164, 210);">Crrer un nouveau client</h2>
                                        </div>
                                        
                                    <form method="POST" action="{{ route('client.store') }}">
                                        @csrf
                                        <div class="modal-body">
                                               
                                            
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
                                    </form>
                                    </div>
                                </div>
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


                    
                </div>
            </div>
            
        </div>
        
       
    </div>
    <br>
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
                    var clientInfo = '<div class="client-info" style="margin-left:37px;">' +
                    
                        '<b>Nom: ' + response.nom + '</b><br>' +
                        '<b>Prénom: ' + response.prenom + '</b> <br>' +
                        '<b>ICE: ' + response.ice + '</b><br>' +
                        '<b>Adresse: ' + response.adresse + '</b> <br>' +
                        '<b>CP: ' + response.cp + '</p> <br>' +
                            '<input type="hidden" name="user_id" id="user_id" value="' + response.id + '">' +

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
                    verifierChamps();

                },
                error: function(xhr, status, error) {
                    console.log(error);
                    $('.client-info').html('<p>Une erreur s\'est produite lors de la récupération des informations du client.</p>');
                }
            });
        }
    }
     </script>
    @include('layouts.footers.auth')
@endsection
<style>
.hidden-button {
    display: none;
  }
  .tableau-container {
        display: flex;
        align-items: center;
        
    }

    .tableau-container table {
        margin-right: 10px;
        margin-bottom: 40px;
    }
    .lig {
        display: flex;
        align-items: center;
    }

    .lig h5 {
        margin: 3px;
    }
</style>

  