@extends('layouts.app')

@section('content')

<div class="container" style="background-color: rgba(215, 228, 247, 0.918)">

    <h2 class="text-center p-3 text-secondary text-white" style="background-color: rgb(58, 80, 133)">Tablero </h2>
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
                    Hola {{ Auth::user()->name }}, ¡Bienvenido a tu inicio de sesión!
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-around m-4">

            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">Solicitudes</h5>
                    <p class="card-text">Aquí podras ver las solicitudes listas para subir a Crossref.</p>
                    <a href="{{ route('admin.solicitudoi') }}" class="btn btn-primary">Ver</a>
                </div>
            </div>
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text">Aquí podrás ver los usuarios que desean tener acceso a la web.</p>
                    <a href="{{ route('admin.userst') }}" class="btn btn-primary">Ver</a>
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
