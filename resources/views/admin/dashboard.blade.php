@extends('layouts.app')
@section('content')
<div class="container">
    <script>
        function cerrar(btn) {
            var card = btn.closest(".card");
            card.style.display = "none";
        }
    </script>
    <h2> Panel de Control</h2>
    <br>
    <ul class="nav nav-pills nav-justified">
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('admin.solicituregist') }}">Solicitudes de Registro</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.solicitudoi') }}">Solicitudes de DOI</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('admin.dois') }}">Lista de Avales </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dois') }}">DOIs</a>
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

                    {{ __('Hola ADMIN, You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

