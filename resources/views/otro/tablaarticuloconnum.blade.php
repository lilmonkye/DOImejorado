@extends('layouts.app')

@section('content')
<h5>con numero x</h5>

<div class="conteiner justify-content-md-center" style="background-color: rgb(215, 228, 247)">
    <h2 class="text-center p-3 text-secondary text-dark" style="background-color: rgb(232, 239, 255)">Artículos Registrados</h2>
    <div style="d-flex justify-content-around; flex-direction:column; justify-content:center; align-items:center" class="col-12 p-3">
        {{-- <input type="hidden" name="idrevista" value="{{ $revista->id }}" class="form-control"> --}}
        <div class="table-responsive d-flex justify-content-between">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <th scope="col"></th>
                    <th scope="col">Título</th>
                    <th scope="col">DOI</th>
                    <th scope="col">URL</th>
                    <th scope="col">Fecha de publicación impresa</th>
                    <th scope="col">Fecha de publicación digital</th>
                    <th scope="col">Primera Página</th>
                    <th scope="col">Última página</th>
                    <th scope="col">Abstract</th>
                    <th scope="col"></th>
                </thead>
                <tbody>
                    @foreach ($articulos as $articulo)
                        <tr>
                            <td>{{ $articulo->id }}</td>
                            <td>{{ $articulo->titulo }}</td>
                            <td>{{ $articulo->doi }}</td>
                            <td>{{ $articulo->url }}</td>
                            <td>{{ $articulo->fechaimpr }}</td>
                            <td>{{ $articulo->fechadig }}</td>
                            <td>{{ $articulo->primerapag }}</td>
                            <td>{{ $articulo->ultimapag }}</td>
                            <td>{{ $articulo->abstract }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
    <div class="d-flex justify-content-center">
        <a href="{{ route('otro.articulo_createconnumero',['idnumero'=>$idnumero]) }} " class="btn btn-secondary" style="margin-left: 40px">Nuevo Artículo </a>
    </div>
    <a href="{{ route('otro_dashboard') }}" class="btn btn-secondary" style="margin-left: 40px">Regresar </a>
</div>
@endsection
