<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
           <!-- <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">-->
           <img src="{{ asset('argon') }}/img/brand/MGAAAA.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/MGAAAA.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                        <i class="fab fa-laravel text-orange" style="color: #1f6de3;"></i>
                        <span class="nav-link-text" style="color: #1f6de3;">{{ __('Ventes') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('Listesfacture') }}">
                                    <!-- <i class=" fa-regular fa-file-invoice" style="color: #4297cd;"></i> -->
                                    <span>{{ __('Factures') }}</span>
                                  
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('ListesfReccurentes')}}">
                                    {{ __('Factures récurrentes') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('ListesDevis')}}">
                                    {{ __('Devis') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('ListesbonCommnd')}}">
                                    {{ __('Bon de Commande') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('ListesbonLivraison')}}">
                                    {{ __('Bon de Livraison') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples-services" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples-services">
                        <i class="ni ni-badge text-orange"></i>
                        <span class="nav-link-text" style="color: #1f6de3;">{{ __('Services') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-examples-services">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('ListesServices')}}">
                                    <!-- <i class=" fa-regular fa-file-invoice" style="color: #4297cd;"></i> -->
                                    <span>{{ __('Services') }}</span>
                                  
                                </a>
                                <a class="nav-link" href="{{route('ListesCategorie')}}">
                                    <!-- <i class=" fa-regular fa-file-invoice" style="color: #4297cd;"></i> -->
                                    <span>{{ __('Categories') }}</span>
                                  
                                </a>
                            </li>
                           
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples-contact" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples-contact">
                        <i class="ni ni-single-02 text-orange"></i>
                        <span class="nav-link-text" style="color: #1f6de3;">{{ __('Contacts') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-examples-contact">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('client.index')}}">
                                    <!-- <i class=" fa-regular fa-file-invoice" style="color: #4297cd;"></i> -->
                                    <span>{{ __('Client') }}</span>
                                  
                                </a>
                                <a class="nav-link" href="{{route('fournisseur.index')}}">
                                    <!-- <i class=" fa-regular fa-file-invoice" style="color: #4297cd;"></i> -->
                                    <span>{{ __('Fournisseur') }}</span>
                                  
                                </a>
                            </li>
                           
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples-achats" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples-achats">
                        <i class="ni ni-single-02 text-orange"></i>
                        <span class="nav-link-text" style="color: #1f6de3;">{{ __('Achats') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-examples-achats">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('ListesAchats')}}">
                                    <!-- <i class=" fa-regular fa-file-invoice" style="color: #4297cd;"></i> -->
                                    <span>{{ __('Achats') }}</span>
                                  
                                </a>
                                <a class="nav-link" href="{{route('ListesCategorieCh')}}">
                                    <!-- <i class=" fa-regular fa-file-invoice" style="color: #4297cd;"></i> -->
                                    <span>{{ __('Catégorie') }}</span>
                                  
                                </a>
                            </li>
                           
                        </ul>
                    </div>
                </li>
              
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-circle-08 text-pink"></i> {{ __('Register') }}
                    </a>
                </li>
              
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">Documentation</h6>
            <!-- Navigation -->
           
        </div>
    </div>
</nav>
