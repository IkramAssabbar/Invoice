@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
<div class="header pb-2 pt-5 pt-lg-5 d-flex align-items-center;">
    <!-- Mask -->
    <span class="mask bg-gradient-grey "></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-md-12 {{ $class ?? '' }}">
                <h1 style="font-family: cursive; color:rgb(27, 164, 210);">Modifier votre Categorie</h1>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-8 col-md-12 col-12">
         <form method="POST" action="{{route('categorieCH.update',$categorie->id)}}">
            @csrf
            @method('PUT')
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
                                <div class="card-header mb-4" style="background-color: rgb(27, 164, 210);"><b>Categories</b></div>
                                <div class="container">
                                    
                                        <div class="mb-3 row">
                                            <label for="Libelle" class="col-sm-4 col-form-label form-label" style="padding-left:30px;">Categorie</label>
                                            <div class="col-sm-8 mb-3 mb-lg-0">
                                                <input type="text" class="form-control " placeholder="Nom de la Categorie" id="categoriename"  style="padding-right:30px;" name="nomCategorie" value="{{$categorie->nomCategorie}}">
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



@include('layouts.footers.auth')
<style>
    .btn-round-lg{
border-radius: 40px;
}
</style>
@endsection
