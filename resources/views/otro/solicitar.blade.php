@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container" style="background-color: rgb(240, 247, 255)">

    <h2 class="text-center p-3 text-secondary" style="background-color: rgba(228, 235, 252, 0.932); text-color:rgb(0, 0, 0)">Solicitar Nuevo DOI</h2>
    <div class="d-flex justify-content-center">
        <div class="btn-group-vertical" role="group" aria-label="Basic radio toggle button group">

            <a href="{{ route('otro.revistaform') }}">
                <button type="button" class="btn btn-outline-primary">  --- Registrar Revista ---    </button>
            </a>
            {{-- <a href="{{ route('otro.articuloform') }}">
            <button type="button" class="btn btn-outline-primary">  --- Artículo ---   </button>
            </a>
            <a href="{{ route('otro.numeroform') }}">
            <button type="button" class="btn btn-outline-primary">  Issue / Número  </button>
            </a> --}}

        </div>
    </div>
    <br>
    <a href="{{ route('otro_dashboard') }}" class="btn btn-secondary">Regresar </a>
</div>
@endsection
