@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container" style="background-color: rgba(215, 228, 247, 0.918)">

    <h2 class="text-center p-3 text-secondary text-white" style="background-color: rgb(32, 66, 146)">Solicitar Nuevo DOI</h2>
    <div class="d-flex justify-content-around p2 m-4">
        <div class="card" style="width: 20rem;">
            <div class="card-body">
                <h5 class="card-title">Nuevo Registro</h5>
                <p class="card-text">Inicia tu registro de un nuevo DOI, registra tu revista y después sus artículos o número correspondiente.</p>
                <a href="{{ route('otro.revistaform') }}" class="btn btn-primary">Registrar</a>
            </div>
        </div>
        <div class="card" style="width: 20rem;">
            <div class="card-body">
                <h5 class="card-title">Mis Revistas</h5>
                <p class="card-text">Registra un DOI para un artículo o número de una revista existente.</p>
                <a href=" {{ route('otro.tablarevista', ['id' => Auth::id()]) }}" class="btn btn-primary">Registrar</a>
            </div>
        </div>
        <div class="card" style="width: 20rem;">
            <div class="card-body">
                <h5 class="card-title">Mis Números</h5>
                <p class="card-text">Registra un DOI para articulos de un número ya registrado.</p>
                <a href="{{ route('otro.revistaform') }}" class="btn btn-primary">Registrar</a>
            </div>
        </div>
    </div>
    <br>
    <a href="{{ route('otro_dashboard') }}" class="btn btn-secondary">Regresar </a>
</div>
@endsection
