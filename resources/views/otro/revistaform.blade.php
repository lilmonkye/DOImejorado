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
    <form>
        @csrf
        <div style="d-flex justify-content-around; justify-content:center; align-items:center" >
{{-- obligatorios --}}

            <div class="mb-3 ">
                <label for="exampleInputPassword1" class="form-label"> + Título de la Revista</label>
                <input type="text" value="{{ isset($usuario->Titulo)?$usuario->Titulo:old('Titulo')}}" class="form-control" name="Titulo">
            </div>

            <div class="mb-3 ">
                <label for="exampleInputPassword1" class="form-label"> Título abreviado de la revista</label>
                <input type="text" value="{{ isset($usuario->Abreviatura)?$usuario->Abreviatura:old('Abreviatura')}}" class="form-control" name="Abreviatura">
            </div>

            <div class="mb-3 ">
                <label for="exampleInputPassword1" class="form-label"> Sufijo DOI de la Revista</label>
                <input type="text" value="{{ isset($usuario->Abreviatura)?$usuario->Abreviatura:old('Abreviatura')}}" class="form-control" name="Doi">
            </div>

            <h5>El url debe comenzar con "https:"</h5>

            <div class="mb-3 ">
                <label for="exampleInputPassword1" class="form-label"> + URL</label>
                <input type="text" value="{{ isset($usuario->Abreviatura)?$usuario->Abreviatura:old('Abreviatura')}}" class="form-control" name="Url">
            </div>

            <h5>Según sea el caso de su revista llenar el ISSN impreso o el ISSN electronico</h5>

            <div class="mb-3 ">
                <label for="exampleInputPassword1" class="form-label"> + ISSN impreso</label>
                <input type="text" value="{{ isset($usuario->Issn)?$usuario->Issn:old('Issn')}}" class="form-control" name="Issnimp">
            </div>

            <div class="mb-3 ">
                <label for="exampleInputPassword1" class="form-label">  + ISSN electronico</label>
                <input type="text" value="{{ isset($usuario->Issn)?$usuario->Issn:old('Issn')}}" class="form-control" name="Issnelec">
            </div>


        </div>
    </form>
    <a href="{{ route('otro.solicitar') }}" class="btn btn-secondary">Regresar </a>
</div>
@endsection
