@extends('layouts.app')

@section('content')

<!-- Enlaces a los archivos CSS -->
<link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/jquery-ui.theme.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css" integrity="sha512-UhKYW4E/L4+mTw/FmBCpr9f6S94W6SvU6icNN0f1gAxuE0Pr71N7OuOUMXsST7bMK/uvrTrT7dQfQOe72JfxdQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script>
    var $j = jQuery.noConflict();
</script>

<!-- Enlaces a los archivos JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-lZFHibo97A3tqYsHY8T/HBSPw9Q/4d/IM4xbW2x2F6oPvdJpGVYa8ZQV+JXJan6SrzU6J4vB8Fx4JfGb9sh4Mw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js" integrity="sha512-pw+QdMj3fUPyAL51XGxJx1CrRt1n+VZgJrvymwLb7+uajP8eV7ocnmXsJxCO7SPHPKr+UnlV7C2kjLwDbl7GjQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js" integrity="sha512-G/cp61fB0ihHUhkzLvJGATdI49F9OoQ2yxnnlCZIe/mx0K5CG/lRNEgrF99gO8QyD5r5XzG5r5gZf0FZr4Hq3w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


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
            Asegurese de que la información del artículo contenga los signos de acentuación y los datos se encuentren en el idioma de publicación
        </div>
    </div>
    <form action="#{{-- {{ url('/otro_revista_create') }} --}}" id="formulario" method="POST" >
        @csrf
        <div style="d-flex justify-content-around; justify-content:center; align-items:center" >

            <div class="mb-3 ">
                <label for="titulo" class="form-label"> + Título del Artículo</label>
                <input type="text" value="{{ isset($articulo->titulo)?$articulo->titulo:old('titulo')}}" class="form-control" name="titulo">
            </div>

            <label for="doi" class="form-label"> ¿Esta revista cuenta con DOI?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="bandoi" id="doi_si">
                <label class="form-check-label" for="doi_si">Si</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="bandoi" id="doi_no">
                <label class="form-check-label" for="doi_no">No</label>
            </div>
            <br>

            <div class="form-group">
                <label for="doi">DOI:</label>
                <input type="text" value="{{ isset($articulo->doi)?$articulo->doi:old('doi')}}" class="form-control" name="doi" id="doi" disabled>
            </div>
            <br>
            <h5>El url debe comenzar con "https://"</h5>

            <div class="mb-3 ">
                <label for="url" class="form-label"> + URL</label>
                <input type="text" value="{{ isset($articulo->url)?$articulo->url:old('url')}}" class="form-control" name="url">
            </div>

            <h5>Según sea el caso de su revista llenar la fecha de publicación impresa, digital o ambas (Aa-Mm-Dd).</h5>

            <div class="mb-3 ">
                <label for="fechaimpr" class="form-label"> + Fecha de Publicación Impresa</label>
                <input type="text" class="form-control datepicker" value="{{ old('fechaimpr')}}" id="fechaimpr" name="fechaimpr">
            </div>

            <div class="mb-3 ">
                <label for="fechadig" class="form-label">  + Fecha de Publicación Digital</label>
                <input type="text" class="form-control datepicker" value="{{ old('fechadig')}}" id="fechadig" name="fechadig">
            </div>

            <div class="d-flex justify-content-center">
                <input type="submit" value="Registrar" id="registro" class="btn btn-secondary btn-submit">
            </div>
        </div>
    </form>
</div>

<script>
    const radios = document.getElementsByName('bandoi');
    const input = document.getElementById('doi');

    radios.forEach(radio => {
      radio.addEventListener('change', function() {
        if (radio.id === 'doi_no') {
          input.disabled = true;
        } else {
          input.disabled = false;
        }
      });
    });
</script>

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
