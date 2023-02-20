@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container" style="background-color: rgb(194, 222, 255)">
    <h2 class="text-center p-3 text-secondary" style="background-color: rgb(255, 246, 197) text-color:whitesmoke">Solicitar Nuevo DOI</h2>

    <form>
        @csrf
        <div style="d-flex justify-content-around; justify-content:center; align-items:center" >
{{-- obligatorios --}}
        <div class="mb-3 ">
            <label for="exampleInputPassword1" class="form-label">+ Título de la Revista</label>
            <input type="text" value="{{ isset($usuario->Titulo)?$usuario->Titulo:old('Titulo')}}" class="form-control" name="Titulo">
        </div>

        <div class="mb-3 ">
            <label for="exampleInputPassword1" class="form-label">+ Título abreviado de la revista</label>
            <input type="text" value="{{ isset($usuario->Abreviatura)?$usuario->Abreviatura:old('Abreviatura')}}" class="form-control" name="Abreviatura">
        </div>

        <h5>Año de publicación e ISSN impreso o electronico</h5>

        <div class="mb-3 ">
            <label for="exampleInputPassword1" class="form-label">+ ISSN</label>
            <input type="text" value="{{ isset($usuario->Issn)?$usuario->Issn:old('Issn')}}" class="form-control" name="Issn">
        </div>

        <div class="mb-3 ">
            <label for="exampleInputPassword1" class="form-label">+ Año de publicación</label>
            <input type="text" value="{{ isset($usuario->Anio)?$usuario->Anio:old('Noemision')}}" class="form-control" name="Anio" >
        </div>
        <div class="mb-3 ">
            <label for="exampleInputPassword1" class="form-label">+ Sufijo</label>
            <input type="text" value="{{ isset($usuario->Sufijo)?$usuario->Sufijo:old('Sufijo')}}" class="form-control" name="Sufijo" >
        </div>
{{--  Hasta aqui son los obligatorios  --}}
{{-- Opcionales --}}
        <div class="mb-3 ">
            <label for="exampleInputPassword1" class="form-label">Número de edición</label>
            <input type="text" value="{{ isset($usuario->Noedicion)?$usuario->Noedicion:old('Noedicion')}}" class="form-control" name="Noedicion" >
        </div>
        <div class="mb-3 ">
            <label for="exampleInputPassword1" class="form-label">Número de volumen</label>
            <input type="text" value="{{ isset($usuario->Novolumen)?$usuario->Novolumen:old('Novolumen')}}" class="form-control" name="Novolumen" >
        </div>
        <div class="mb-3 ">
            <label for="exampleInputPassword1" class="form-label">Número de emisión</label>
            <input type="text" value="{{ isset($usuario->Noemision)?$usuario->Noemision:old('Noemision')}}" class="form-control" name="Noemision" >
        </div>
{{-- Aqui terminal los opcionales --}}
        <div class="text-center"><input type="submit" class="btn btn-primary" value="Solicitar"></div>

        <a href="{{ route('otro_dashboard') }}" class="btn btn-light">Regresar </a>
    </form>
</div>
</div>
@endsection
