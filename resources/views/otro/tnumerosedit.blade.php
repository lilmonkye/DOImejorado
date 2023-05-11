@extends('layouts.app')

@section('head')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@endsection

@section('content')


<div class="container justify-content-md-center" style="background-color: rgb(215, 228, 247)">
    <h2 class="text-center p-3 text-secondary text-white" style="background-color: rgb(58, 80, 133)">Números Registrados</h2>
    <div style="d-flex justify-content-around; flex-direction:column; justify-content:center; align-items:center" class="col-12 p-3">

        <div class=" d-flex justify-content-between table-responsive">
            <table class="table table-hover table-light">
                <thead class="table-active">
                    <th scope="col"></th>
                    <th scope="col">Número</th>
                    <th scope="col">Título</th>
                    <th scope="col">DOI</th>
                    <th scope="col">URL</th>
                    <th scope="col">Fecha de publicación impresa</th>
                    <th scope="col">Fecha de publicación digital</th>
                    <th scope="col">Número Especial</th>
                    <th scope="col">Volumen</th>
                    <th scope="col">DOI del Volumen</th>
                    <th scope="col">URL del Volumen</th>
                    <th scope="col"></th>
                </thead>
                <tbody>
                    @foreach ($numeros as $numero)
                        <tr>
                            <td>{{ $numero->id }}</td>
                            <td>{{ $numero->numero }}</td>
                            <td>{{ $numero->titulo }}</td>
                            <td>{{ $numero->doi }}</td>
                            <td>{{ $numero->url }}</td>
                            <td>{{ $numero->fechaimpr }}</td>
                            <td>{{ $numero->fechadig }}</td>
                            <td>{{ $numero->numespecial }}</td>
                            <td>{{ $numero->volumen }}</td>
                            <td>{{ $numero->volumendoi }}</td>
                            <td>{{ $numero->volumenurl }}</td>
                            <td>
                                <a href="{{ route('otro.numeroEdit',$numero->id) }}" type="button" class="btn btn-warning">Editar</a>
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
