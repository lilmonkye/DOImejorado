@extends('layouts.app')

@section('content')


<div class="conteiner justify-content-md-center" style="background-color: rgb(215, 228, 247)">
    <h2 class="text-center p-3 text-secondary text-dark" style="background-color: rgb(232, 239, 255)">Números Registrados</h2>
    <div style="d-flex justify-content-around; flex-direction:column; justify-content:center; align-items:center" class="col-12 p-3">

        <div class="table-responsive d-flex justify-content-between">
            <table class="table table-hover">
                <thead class="thead-dark">
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
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
    <div class="d-flex justify-content-center">
        <a href="{{ route('otro.numero_create',['idrevista'=>$idrevista]) }} " class="btn btn-secondary" style="margin-left: 40px">Nuevo Número </a>
    </div>
    <a href="{{ route('otro_dashboard') }}" class="btn btn-secondary" style="margin-left: 40px">Regresar </a>
</div>
@endsection
