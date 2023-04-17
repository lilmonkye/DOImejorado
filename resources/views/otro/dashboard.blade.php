@extends('layouts.app')

@section('content')

<div class="container" style="background-color: rgba(215, 228, 247, 0.918)">

    <h2 class="text-center p-3 text-secondary text-white" style="background-color: rgb(58, 80, 133)">Solicitud de DOI </h2>
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
                    {{ __('Hola USUARIO, ¡Bienvenido a tu inicio de sesión!') }}
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-around m-4">

            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">Mis Registro</h5>
                    <p class="card-text">Aquí podras ver tus revistas, artículos y números registrados.Tambien podras realizar correcciones de los mismos.</p>
                    <a href="#" class="btn btn-primary">Ver</a>
                </div>
            </div>
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">Solicitar</h5>
                    <p class="card-text">Aquí podras solicitar un DOI para revistas, artículos y números.</p>
                    <a href="{{ route('otro.solicitar') }}" class="btn btn-primary">Ver</a>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-around m-4">

            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">Mis Solicitudes</h5>
                    <p class="card-text">Aquí ver el estatus de tus solicitudes y correcciones que debas realizar.</p>
                    <a href="{{ route('otro.tsolicitudes') }}" class="btn btn-primary">Ver</a>
                </div>
            </div>
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">Mis DOIs</h5>
                    <p class="card-text">Aquí podras consultar tus DOIs creados.</p>
                    <a href="{{ route('otro.userdoi') }}" class="btn btn-primary">Ver</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function cerrar(btn) {
        var card = btn.closest(".card");
        card.style.display = "none";
    }
</script>
@endsection

