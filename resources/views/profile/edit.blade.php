<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

@extends('../layouts/app')
@section('title', 'Perfíl de usuario')
@section('content')
<div class="p-4" style="color:red">
    <ul>
        @foreach ($errors->profile->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>

    <input type="hidden" name="csrf-token" content="{{ csrf_token() }}" />
    <div class="notification is-danger p-4 m-4">
        Ha ocurrido un error al borrar su cuenta de usuario, inténtelo de nuevo mas tarde.
    </div>
    <div class="editar-perfil">
        <div style="max-width:30rem">
            <h1 class="title">Perfil de <i class="has-text-info" style="text-decoration: underline; font-style:normal;">{{Auth::user()->name}}</i></h1>
            <div class="card p-4">
                <figure class="image is-64x64">
                    <img src="https://ui-avatars.com/api/?name={{Auth::user()->name}}" alt="Foto de perfil de {{Auth::user()->name}}" class="is-rounded"> 
                </figure>
                <div class="card-content">
                <div class="content">
                    <p><strong>Nombre:</strong> {{Auth::user()->name}}</p>
                    <p><strong>Email:</strong> {{Auth::user()->email}}</p>
                    <p><strong>Fecha de creación:</strong> {{date("d/m/Y", strtotime(Auth::user()->created_at))}}</p>
                </div>
                </div>
                <footer class="card-footer" style="display:flex; flex-direction:column; gap:.5em;">
                    <button class="card-footer-item button is-primary" onclick="toggleFormularioVisibility()">Modificar usuario</button>
                    <button class="card-footer-item button is-danger" onclick="deleteAccount()" id="btnDelete">Borrar cuenta</button>
                </footer>
          </div>
        </div>
    
        <form class="formulario-perfil slide-in-left" action="{{ route('profile.update') }}" method="POST" style="width:100%">
            @csrf
            @method('patch')
            <div class="field">
              <label for="nombre">Nombre</label>
              <input type="text" id="nombre" name="nombre" placeholder="Nombre" value="{{old('nombre')}}">
            </div>
          
            <div class="field">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" placeholder="Email" value="{{old('email')}}">
            </div>
          
            <div class="field">
              <label for="contrasenaactual">Contraseña actual</label>
              <input type="password" id="contrasena-actual" name="contrasenaactual" placeholder="Contraseña actual">
            </div>
          
            <div class="field">
              <label for="nuevacontrasena">Nueva contraseña</label>
              <input type="password" id="nueva-contrasena" name="nuevacontrasena" placeholder="Nueva contraseña">
            </div>
          
            <div class="field">
              <label for="confirmarcontrasena">Confirmar contraseña</label>
              <input type="password" id="confirmar-contrasena" name="confirmarcontrasena" placeholder="Confirmar contraseña">
            </div>
          
            <div class="button-group">
              <button class="button primary">Guardar cambios</button>
            </div>
          </form>
    </div>

    <script>
        $(".formulario-perfil").hide();
        if ({{$errors->profile->count()}} > 0){
            $(".formulario-perfil").show()
        }
        $(".notification").hide();
        // Mostrar formulario cuando se de al botón de "Modificar perfil"
        function toggleFormularioVisibility() {
            $(".formulario-perfil").show();
        }

        function deleteAccount(){
            $(".notification").hide();
            $("#btnDelete").attr('disabled', true);
            if(confirm("¿Seguro que quieres borrar tu cuenta?")){
                //Post request to /logout
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
                    }
                })
                $.ajax({
                    type: "DELETE",
                    url: "/profile",
                    success: function(data){
                        window.location.href = "/";
                        $("#btnDelete").prop('disabled', false);
                    },
                    error: function(){
                        $(".notification").show();
                        $("#btnDelete").prop('disabled', false);
                    }
                })
            }
        }
    </script>
      
      <style>
        form {
          max-width: 400px;
          margin: 0 auto;
        }
      
        .field {
          margin-bottom: 1rem;
        }
      
        label {
          display: block;
          font-weight: bold;
          margin-bottom: 0.5rem;
        }
      
        input[type="text"],
        input[type="email"],
        input[type="password"] {
          width: 100%;
          padding: 0.5rem;
          border: 1px solid #ccc;
          border-radius: 4px;
        }
      
        .button-group {
          display: flex;
          justify-content: flex-end;
          margin-top: 1rem;
        }
      
        .button {
          margin-left: 0.5rem;
        }
      
        .primary {
          background-color: #3273dc;
          color: #fff;
        }
        .slide-in-left {
	        -webkit-animation: slide-in-left 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
	        animation: slide-in-left 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        }
        /* ----------------------------------------------
        * Generated by Animista on 2023-8-29 18:46:26
        * Licensed under FreeBSD License.
        * See http://animista.net/license for more info. 
        * w: http://animista.net, t: @cssanimista
        * ---------------------------------------------- */

        /**
        * ----------------------------------------
        * animation slide-in-left
        * ----------------------------------------
        */
        @-webkit-keyframes slide-in-left {
        0% {
            -webkit-transform: translateX(-1000px);
                    transform: translateX(-1000px);
            opacity: 0;
        }
        100% {
            -webkit-transform: translateX(0);
                    transform: translateX(0);
            opacity: 1;
        }
        }
        @keyframes slide-in-left {
        0% {
            -webkit-transform: translateX(-1000px);
                    transform: translateX(-1000px);
            opacity: 0;
        }
        100% {
            -webkit-transform: translateX(0);
                    transform: translateX(0);
            opacity: 1;
        }
        }

      </style>
@endsection