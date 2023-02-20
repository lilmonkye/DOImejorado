@extends('layouts.app')

@section('content')

<div class="container">
    <script>
        function cerrar(btn) {
            var card = btn.closest(".card");
            card.style.display = "none";
        }
    </script>
    <h2>Solicitud de DOI </h2>
    <br>
    <ul class="nav nav-pills nav-justified margin-top">
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('otro.solicitar') }}">Solicitar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('otro.tsolicitudes') }}">Mis Solicitudes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('otro.userdoi') }}">Mis DOIs</a>
        </li>
    </ul>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">{{ __('Bienvenido') }}
                    <button type="button" class="btn-close" style="float:right" aria-label="Close" onclick="cerrar(this)"></button>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('Hola USUARIO, You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

