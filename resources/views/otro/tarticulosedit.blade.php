@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')

<div class="container justify-content-md-center" style="background-color: rgb(215, 228, 247)">
    <h2 class="text-center p-3 text-secondary text-white" style="background-color: rgb(58, 80, 133)">Articulos Registradas</h2>
    <div style="d-flex justify-content-around; flex-direction:column; justify-content:center; align-items:center" class="col-12 p-5">
        <div class=" d-flex justify-content-between table-responsive">
            <table class="table table-hover table-light">
                <thead class="table-active">
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
                            <td>{{ $articulo->primerpag }}</td>
                            <td>{{ $articulo->ultimapag }}</td>
                            <td>{{ $articulo->abstract }}</td>
                            <td>
                                <button type="button" class="btn btn-warning">Editar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
    <div class="p-3">
        <a href="{{ route('otro.registros') }}" class="btn btn-secondary" style="margin-left: 40px">Regresar </a>
    </div>
</div>
@endsection
