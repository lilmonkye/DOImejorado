@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container" style="background-color: rgba(215, 228, 247, 0.918)">

    <h2 class="text-center p-3 text-secondary text-white" style="background-color: rgb(58, 80, 133)">Registros</h2>
    <div class="d-flex justify-content-around p2 m-4">
        <div class="card" style="width: 15rem;">
            <div class="card-body">
                <h5 class="card-title">Revistas</h5>
                <p class="card-text">Edita tus revistas.</p>
                <a href="{{ route('otro.trevistasedit') }}" class="btn btn-primary">Editar</a>
            </div>
        </div>
        <div class="card" style="width: 15rem;">
            <div class="card-body">
                <h5 class="card-title">Artículos</h5>
                <p class="card-text">Edita tus Artículos.</p>
                <a href=" {{ route('otro.tarticulosedit') }}" class="btn btn-primary">Editar</a>
            </div>
        </div>
        <div class="card" style="width: 15rem;">
            <div class="card-body">
                <h5 class="card-title">Números</h5>
                <p class="card-text">Edita tus Números.</p>
                <a href="{{ route('otro.tnumerosedit') }}" class="btn btn-primary">Editar</a>
            </div>
        </div>
        <div class="card" style="width: 15rem;">
            <div class="card-body">
                <h5 class="card-title">Contribuidor</h5>
                <p class="card-text">Edita tus Contribuidores.</p>
                <a href="{{ route('otro.tcontribuidorsedit') }}" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>

    <div class="p-2 mb-3">
        <a href="{{ route('otro_dashboard') }}" class="btn btn-secondary">Regresar </a>
    </div>
</div>
@endsection
