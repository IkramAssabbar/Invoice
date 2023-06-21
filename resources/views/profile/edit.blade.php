@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Bienvenue') . ' '. auth()->user()->name,
        
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-2">
                <div class="card card-profile shadow">
                    
                  
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    <div>
                                        <span class="heading">22</span>
                                        <span class="description">{{ __('Friends') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">10</span>
                                        <span class="description">{{ __('Photos') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">89</span>
                                        <span class="description">{{ __('Comments') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3>
                                {{ auth()->user()->name }}<span class="font-weight-light">, 27</span>
                            </h3>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>{{ __('Bucharest, Romania') }}
                            </div>
                            <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>{{ __('Solution Manager - Creative Tim Officer') }}
                            </div>
                            <div>
                                <i class="ni education_hat mr-2"></i>{{ __('University of Computer Science') }}
                            </div>
                            <hr class="my-4" />
                            <p>{{ __('Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music.') }}</p>
                            <a href="#">{{ __('Show more') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-0">
                <div class="card bg-secondary shadow">
                    <div class=" bg-blu" style="padding: 0rem 1.5rem">
                        <div class="row align-items-center">
                            <h3 class="mb-0" style="font-family: sans-serif; color: white">{{ __('Facture') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-white border-0">
                    <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                        @csrf
                        @method('put')
            
                        <div>
                            <img src="{{ asset('argon') }}/img/brand/facture.png" class="upload-icon">
                            <input type="file" id="photo" class="hidden">
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <b-form-textarea name="" id="" cols="30" no-resize readonly data-bs-toggle="modal"
                                    data-bs-target="#myModal" class="custom-textarea">
                                    Morroco <br>
                                    fes 30000 <br>
                                    RIB :08783939383<br>
                                    tel:0674321490
                                </b-form-textarea>
                            </div>
            
                            <div class="col-md-6">
                                <h4 style="font-family: cursive; color:rgb(27, 164, 210);margin-left: 50px;">Choisissez ou
                                    créez un client</h4>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('argon') }}/img/brand/fleche.png" alt="" style="width: 50px;">
                                    <select class="form-select">
                                        <option value="option1">Option 1</option>
                                        <option value="option2">Option 2</option>
                                        <option value="option3">Option 3</option>
                                    </select>
                                </div>
                                <!-- Dropdown liste ici -->
                            
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
            
                                                <input type="text" class="form-control" id="inputPays" placeholder="ICE">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
            
                                                <input type="text" class="form-control" id="Nom" placeholder="Pays">
                                            </div>
                                            <div class="col-md-6 mb-3">
            
                                                <input type="text" class="form-control" id="inputPays" placeholder="Adresse">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
            
                                                <input type="text" class="form-control" id="Pays" placeholder="CP">
                                            </div>
                                            <div class="col-md-4 mb-3">
            
                                                <input type="text" class="form-control" id="inputPays" placeholder="Ville">
                                            </div>
                                            <div class="col-md-4 mb-3">
            
                                                <input type="text" class="form-control" id="inputPays" placeholder="telephone">
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

                        <!-- facture box-->
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <b-form-textarea name="" id="" cols="30" no-resize readonly data-bs-toggle="modal"
                                    data-bs-target="#myModale" class="custom-textarea">
                                    <b>Facture</b> <br>
                                    Date: <br>
                                    Echéance :<br>
                                   
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
            
                                                <input type="text" class="form-control" id="inputNom" placeholder="Date">
                                            </div>
                                            <div class="col-md-6 mb-3">
            
                                                <input type="text" class="form-control" id="inputPays" placeholder="Echeance">
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
                        
                        <table class="table " data-bs-toggle="modal" data-bs-target="#myModaltab">
                            <thead  >
                              <tr  >
                                
                                <th scope="col" ><b>Service </b></th>
                                <th scope="col"><b> Description</b></th>
                                <th scope="col"><b> Montant</b></th>
                              </tr>
                            </thead>

                            <tbody>
                              <tr>
                              
                                <td>Design</td>
                                <td>flayer</td>
                                <td>1200</td>
                              </tr>
                              <tr>
                                
                                <td>Developpement</td>
                                <td>site web</td>
                                <td>2000</td>
                              </tr>
                              
                            </tbody>
                         
                        </table>
                            <!-- Bouton pour ouvrir le modal -->

                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-lg" id="myModaltab" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="modal-title" id="myModaltab"  style="font-family: cursive; color:rgb(27, 164, 210);">Ajouter ou modifier des services</h2>
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
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>REF-001</td>
                                                        <td>Produit A</td>
                                                        <td>10€</td>
                                                        <td>5%</td>
                                                        <td>20%</td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-sm">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-primary btn-sm " data-bs-toggle="modal" data-bs-target="#editModal">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        </td>
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
                            <div class="modal fade bd-example-modal-lg" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="modal-title" id="myModaltab"  style="font-family: cursive; color:rgb(27, 164, 210);">Ajouter ou modifier des services</h2>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="modal-body">
                                                <!-- Champs de saisie -->
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
                                                            <td> <input type="text" class="form-control" id="inputNom" >  </td>
                                                            <td><input type="text" class="form-control" id="inputNom" ></td>
                                                            <td><input type="text" class="form-control" id="inputNom" ></td>
                                                            <td><input type="text" class="form-control" id="inputNom" ></td>
                                                            <td><input type="text" class="form-control" id="inputNom" ></td>
                                                            <td><textarea type="text" class="form-control" id="inputNom" rows="2"></textarea></td>
                                                            
                                                        </tr>
                                                        <!-- Ajoutez d'autres lignes ici -->
                                                    </tbody>
                                                </table>
                                            
                                            </div>
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
    <br>
    @include('layouts.footers.auth')
@endsection
