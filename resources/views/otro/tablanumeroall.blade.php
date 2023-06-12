@extends('layouts.app')

@section('head')

    <!-- Enlaces a los archivos CSS -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css" integrity="sha512-UhKYW4E/L4+mTw/FmBCpr9f6S94W6SvU6icNN0f1gAxuE0Pr71N7OuOUMXsST7bMK/uvrTrT7dQfQOe72JfxdQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">


    <!-- Enlaces a los archivos JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js" integrity="sha512-pw+QdMj3fUPyAL51XGxJx1CrRt1n+VZgJrvymwLb7+uajP8eV7ocnmXsJxCO7SPHPKr+UnlV7C2kjLwDbl7GjQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js" integrity="sha512-G/cp61fB0ihHUhkzLvJGATdI49F9OoQ2yxnnlCZIe/mx0K5CG/lRNEgrF99gO8QyD5r5XzG5r5gZf0FZr4Hq3w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


@endsection

@section('content')


<div class="container justify-content-md-center" style="background-color: rgb(215, 228, 247)">
    <h2 class="text-center p-3 text-secondary text-white" style="background-color: rgb(58, 80, 133)">Números Registrados</h2>
    <div style="d-flex justify-content-around; flex-direction:column; justify-content:center; align-items:center" class="col-12 p-3">

        <div class=" d-flex justify-content-between table-responsive">
            <table class="table table-hover table-light">
                <thead class="table-active">
                    <th scope="col" style="display:none"></th>
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
                    <th scope="col"></th>
                </thead>
                <tbody>
                    @foreach ($numeros as $numero)
                        <tr>
                            <td style="display:none">{{ $numero->id }}</td>
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
                                <a href="{{ route('otro.aniadirArticulonum',$numero->id) }}" class="btn btn-success" type="button" class="btn btn-warning">Articulo</a>
                            </td>
                            <td>
                                <a href="{{ route('otro.aniadirContribuidor',$numero->id) }}" class="btn btn-info" type="button" class="btn btn-warning">Contribuidor</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
    {{-- <div class="d-flex justify-content-center">
        <a href="# " class="btn btn-secondary" style="margin-left: 40px">Nuevo Número </a>
    </div> --}}
    <div class="p-2 mb-3">
        <a href="{{ route('otro.solicitar') }}" class="btn btn-secondary" style="margin-left: 40px">Regresar </a>
    </div>
</div>
@endsection
