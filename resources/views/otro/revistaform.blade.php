@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container" style="background-color: rgb(215, 228, 247)">
    <h2 class="text-center p-3 text-secondary text-dark" style="background-color: rgb(232, 239, 255)">Revista</h2>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
    </svg>
    <div class="alert alert-primary d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
        <div>
            Asegurese de que el nombre de la revista contenga los signos de acentuación y los datos se encuentren en el idioma de publicación
        </div>
    </div>
    <form action="{{ url('/otro') }}" method="post" >
        @csrf
        <div style="d-flex justify-content-around; justify-content:center; align-items:center" >
{{-- obligatorios --}}

            <div class="mb-3 ">
                <label for="titulo" class="form-label"> + Título de la Revista</label>
                <input type="text" value="{{ isset($revista->titulo)?$revista->titulo:old('titulo')}}" class="form-control" name="titulo">
            </div>

            <div class="mb-3 ">
                <label for="tituloabr" class="form-label"> Título abreviado de la revista</label>
                <input type="text" value="{{ isset($revista->tituloabr)?$revista->Abreviatura:old('tituloabr')}}" class="form-control" name="tituloabr">
            </div>

            <div class="mb-3 ">
                <label for="doi" class="form-label"> DOI de la Revista (en caso de tener)</label>
                <input type="text" value="{{ isset($revista->doi)?$revista->doi:old('doi')}}" class="form-control" name="doi">
            </div>

            <h5>El url debe comenzar con "https:"</h5>

            <div class="mb-3 ">
                <label for="url" class="form-label"> + URL</label>
                <input type="text" value="{{ isset($revista->url)?$revista->url:old('url')}}" class="form-control" name="url">
            </div>

            <h5>Según sea el caso de su revista llenar el ISSN impreso o el ISSN electronico</h5>

            <div class="mb-3 ">
                <label for="issnimp" class="form-label"> + ISSN impreso</label>
                <input type="text" value="{{ isset($revista->issnimp)?$revista->Issn:old('issnimp')}}" class="form-control" name="issnimp">
            </div>

            <div class="mb-3 ">
                <label for="exampleInputPassword1" class="form-label">  + ISSN electronico</label>
                <input type="text" value="{{ isset($usuario->Issn)?$usuario->Issn:old('Issn')}}" class="form-control" name="Issnelec">
            </div>


        </div>
    </form>
    <div class="d-flex justify-content-center">
        <input type="submit" name="Registrar" class="btn btn-secondary">
    </div>
    <a href="{{ route('otro.solicitar') }}" class="btn btn-secondary">Regresar </a>
</div>
@endsection
