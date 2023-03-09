@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container" style="background-color: rgb(194, 222, 255)">
    <h2 class="text-center p-3 text-secondary" style="background-color: rgb(255, 246, 197) text-color:whitesmoke">Issue / Número</h2>

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
        </div>
    </form>
    <a href="{{ route('otro.solicitar') }}" class="btn btn-secondary">Regresar </a>
</div>
@endsection
