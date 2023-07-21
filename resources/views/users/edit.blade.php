@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
<div class="header pb-8 pt-5 pt-lg-5 d-flex align-items-center;">
    <!-- Mask -->
    <span class="mask bg-gradient-grey "></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-md-12 {{ $class ?? '' }}">
                <h1 style="font-family: cursive; color:rgb(27, 140, 210);">Préférences</h1>
                <h2 style="font-family: cursive; color:rgb(47, 139, 221);margin-inline-start: 15px;">Mon profile</h2>
                @if (isset($description) && $description)
                <p class="text-white mt-0 mb-5" style="background-color: rgb(59, 145, 215)">{{ $description }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
    <div class="card">
        <div class="row">
            <button type="button" class="btn btn-link no-focus" id="btnChangePassword"
                style=" background: none; margin: 20px;font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;font-size: 17px; color: #313131; margin-inline-start: -320px;text-decoration: none;">
                <i class="fas fa-key" style="color: #030202;margin: 10px;"></i> Changer le mot de passe
            </button>
            <div id="changePasswordSection" class="d-none">
                <form action="{{ route('change.password') }}" method="POST">
                    @csrf
                    @method('PUT')
            
                    <div class="col-md-5 mb-3" style="margin: 20px">
                        <label for="password" style="font-size: 13px;">Mot de passe actuel *:</label>
                        <input type="password" id="password" name="password" style="width: 100%; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
            
                    <div class="col-md-5 mb-3" style="margin: 20px">
                        <label for="newpassword" style="font-size: 13px;">Nouveau mot de passe *:</label>
                        <input type="password" id="newpassword" name="newpassword" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                        @error('newpassword')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-5 mb-3" style="margin: 20px">
                        <label for="newpassword_confirmation" style="font-size: 13px;">Confirmation du nouveau mot de passe *:</label>
                        <input type="password" id="newpassword_confirmation" name="newpassword_confirmation" style="width: 100%;  box-shadow: 2px 2px 4px rgba(2, 0, 0, 0.2);padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                    </div>
            
                    <div class="col-md-12" style="margin: 20px;">
                        <button type="submit" class="btn btn-primary" style="background-color: #428bca; color: #fff;">Enregistrer</button>
                    </div>
                </form>
            </div>
            
            
            <form action="{{ route('user.update', ['user' => auth()->user()->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12 mb-3" style="margin: 40px">
                                <label for="inputName" style="font-size: 13px;">Nom :</label><br>
                                <input type="text" id="name" name="name" value="{{ auth()->user()->name }}"
                                    style="width: 340px; padding: 8px; border-radius: 4px; border: 1px solid #ccc; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">
                            </div>
                            <div class="col-md-12 mb-3" style="margin: 40px;margin-top: 10px">
                                <label for="inputEmail" style="font-size: 13px;">Email : </label><br>
                                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}"
                                    style="width: 340px; padding: 8px; border-radius: 4px; border: 1px solid #ccc; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="col-md-12 mb-3" style="margin: 75px;margin-inline-start: 60px; ">
                            <div style="border-radius: 50%; overflow: hidden; position: relative; width: 110px; height: 110px; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">
                                <label for="img" style="display: inline-block; cursor: pointer; width: 100%; height: 100%;">
                                    <img id="img_preview" src="{{ asset('users/' . auth()->user()->img) }}" alt="Photo de profil"
                                        style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                    <span
                                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: #605f5f; font-weight: bold; text-align: center; opacity: 0; transition: opacity 0.3s ease;">
                                    </span>
                                </label>
                                <input type="file" id="img" name="img" style="display: none;">
                            </div>
                        </div>
                    </div>
                <div class="col-md-12" style="margin: 20px;margin-inline-start: 40px;">
                    <button type="submit" class="btn btn-primary" style="background-color: #428bca; color: #fff;">Modifier</button>
                </div>
            </form>
            
        </div>
    </div>
    <br>


    <script>
        document.getElementById('img').addEventListener('change', function(event) {
            var preview = document.getElementById('img_preview');
            preview.src = URL.createObjectURL(event.target.files[0]);
            preview.onload = function() {
                URL.revokeObjectURL(preview.src); 
            };
    
            var spanText = preview.nextElementSibling;
            if (spanText) {
                spanText.style.opacity = 0;
            }
        });
    </script>
    <script>
        document.getElementById('btnChangePassword').addEventListener('click', function() {
            var changePasswordSection = document.getElementById('changePasswordSection');
            if (changePasswordSection.classList.contains('d-none')) {
                changePasswordSection.classList.remove('d-none');
            } else {
                changePasswordSection.classList.add('d-none');
            }
        });

        document.getElementById('img_upload').addEventListener('change', function(event) {
            var preview = document.getElementById('img');
            preview.src = URL.createObjectURL(event.target.files[0]);
            preview.onload = function() {
                URL.revokeObjectURL(preview.src); 
            };

            var spanText = preview.nextElementSibling;
            if (spanText) {
                spanText.style.opacity = 1;
            }
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-REr8b0dj6Pe7h+Mv/gx1q+O/tg8g+KQwqE/x51n0+y5S8xxZ9nROQzCK3xT6acR4EhlGgxdy3BEbs7eW6NU+

    @include('layouts.footers.auth')
@endsection
