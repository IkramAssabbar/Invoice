@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
<div class="header  py-7 py-lg-8" style="background-color: #328fd3">
        <div class="container">
            <!-- <div class="header-body text-center mt-7 mb-7">
                 <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-6">
                        <h1 class="text-white">{{ __('Welcome to Maroc Generation Agency Invoice Manager.') }}</h1>
                    </div>
                </div> 
                
            </div>-->
            <section class="cards" id="services">
                <div class="contente">
                    <div class="carde">
                        <div class="icon">
                            <i class="fas fa-briefcase fa-beat"></i>
                        </div>
                        <div class="info">
                            <h3>Espace Assistant</h3>
                            <a  class="nav-link">
            
                                <p>
                                    Login
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="carde">
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="info">
                            <h3>Espace Client</h3>
                            <a  class="nav-link">
                                
                                <p>
                                    Login
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="carde">
                        <div class="icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="info">
                            <h3>Espace Admin</h3>
                            <a  class="nav-link">
            
                                <p>
                                    Login
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div> 

        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>

    <div class="container mt--10 pb-5"></div>
@endsection
