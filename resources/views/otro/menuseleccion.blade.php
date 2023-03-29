@extends('layouts.app')

@section('content')

<!-- Enlaces a los archivos CSS -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css" integrity="sha512-UhKYW4E/L4+mTw/FmBCpr9f6S94W6SvU6icNN0f1gAxuE0Pr71N7OuOUMXsST7bMK/uvrTrT7dQfQOe72JfxdQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">


<!-- Enlaces a los archivos JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js" integrity="sha512-pw+QdMj3fUPyAL51XGxJx1CrRt1n+VZgJrvymwLb7+uajP8eV7ocnmXsJxCO7SPHPKr+UnlV7C2kjLwDbl7GjQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js" integrity="sha512-G/cp61fB0ihHUhkzLvJGATdI49F9OoQ2yxnnlCZIe/mx0K5CG/lRNEgrF99gO8QyD5r5XzG5r5gZf0FZr4Hq3w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<div class="container" style="background-color: rgb(215, 228, 247)">
    <h2 class="text-center p-3 text-secondary text-dark" style="background-color: rgb(232, 239, 255)">Continuar Registro</h2>
    <div style="d-flex justify-content-around; justify-content:center; align-items:center" >
        @if(Session::has('msg'))
                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                    <div class="toast-header">
                        <strong class="mr-auto">Mensaje</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        {{ Session::get('msg') }}
                    </div>
                </div>
        @endif
        <div class="d-flex justify-content-center p2">
            <div class="btn-group btn-group-vertical" role="group" aria-label="Basic radio toggle button group">
                <br>
                <a href="{{ route('otro.numeroform') }}">
                    <button type="button" class="btn btn-outline-primary"> Número </button>
                </a>
                <br>
                <a href="{{ route('otro.articuloform') }}">
                    <button type="button" class="btn btn-outline-primary"> Artículo </button>
                </a>
            </div>
        </div>
        <div class="d-flex justify-content-end" aria-label="Basic radio toggle button group">
            <div class="p-2">
                <a href="{{ route('otro.solicitar') }}" class="btn btn-dark"> Terminar Registro </a>
            </div>
        </div>
    </div>
</div>

    <script>
        @if(Session::has('msg'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "3000",
                "extendedTimeOut": "1000"
            }
            toastr.success("{{ Session::get('msg') }}");
        @endif
    </script>


@endsection
