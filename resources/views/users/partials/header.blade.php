<div class="header pb-8 pt-5 pt-lg-5 d-flex align-items-center" style="background-image: url(../argon/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
    <!-- Mask -->
    <span class="mask bg-gradient-dark "></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-md-12 {{ $class ?? '' }}">
                <!--<h1 class=" text-white">{{ $title }}</h1>-->
            <h1 class=" text-white">Créer votre facture </h1>
                @if (isset($description) && $description)
                    <p class="text-white mt-0 mb-5" style="background-color: rgb(59, 145, 215)">{{ $description }}</p>
                @endif
            </div>
        </div>
    </div>
</div> 