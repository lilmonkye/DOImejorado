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
    <div class="container" style="background-color: rgb(215, 228, 247)">
        <h2 class="text-center p-3 text-secondary text-white" style="background-color: rgb(58, 80, 133)">Revista</h2>
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

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <form action="{{ url('/otro_revista_create') }}" id="formulario" method="POST" >
            @csrf
            <div style="d-flex justify-content-around; justify-content:center; align-items:center" >

                <div class="mb-3 ">
                    <label for="titulo" class="form-label"> + Título de la Revista</label>
                    <input type="text" value="{!! isset($revista->titulo)?$revista->titulo:old('titulo') !!}" class="form-control" name="titulo">
                </div>

                <div class="mb-3 ">
                    <label for="tituloabr" class="form-label"> Título abreviado de la revista</label>
                    <input type="text" value="{!! isset($revista->tituloabr)?$revista->Abreviatura:old('tituloabr') !!}" class="form-control" name="tituloabr">
                </div>

                <div>

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
                    <div class="mb-3 form-group">
                        <label for="doi">DOI:</label>
                        <input type="text" value="{!! isset($revista->doi)?$revista->doi:old('doi') !!}" class="form-control" name="doi" id="doi" disabled>
                    </div>

                </div>

                <div class="mb-3 ">
                    <label for="url" class="form-label"> + URL</label>
                    <input type="text" placeholder="https://ejemplo.com" value="{!! isset($revista->url)?$revista->url:old('url') !!}" class="form-control" name="url">
                </div>

                <h5>Según sea el caso de su revista llenar el ISSN impreso o el ISSN electronico (solo usar números)</h5>
                <div class="row ">

                        <div class="col mb-3">
                            <label for="issnimp" class="form-label"> + ISSN impreso</label>
                            <input type="text" value="{!! isset($revista->issnimp)?$revista->issnimp:old('issnimp') !!}" placeholder="p.ej. 1234-5678 " class="form-control" name="issnimp">
                        </div>

                        <div class="col mb-3">
                            <label for="exampleInputPassword1" class="form-label">  + ISSN electrónico</label>
                            <input type="text" value="{!! isset($revista->issnelec)?$revista->issnelec:old('issnelec') !!}" placeholder="p.ej. 1234-5678 " class="form-control" name="issnelec">

                    </div>
                </div>

                <div class="mb-3">
                    <label for="nombre" class="form-lablel mb-3">Idioma de Publicación</label>
                    <select class="form-select" name="idioma" aria-label="Default select example">
                        <option selected></option>
                        <option value="espaniol">Español</option>
                        <option value="ingles">Inglés</option>
                        <option value="chino">Chino Mandarín</option>
                        <option value="frances">Francés</option>
                        <option value="japones">Japonés</option>
                        <option value="italiano">Italiano</option>
                        <option value="polaco">Polaco</option>
                        <option value="portugues">Portugués</option>
                        <option value="holandes">Holandés</option>
                        <option value="ruso">Ruso</option>
                    </select>
                </div>

            </div>
            <div class="d-flex justify-content-center">
                <input type="submit" value="Registrar" id="registro" class="btn btn-secondary btn-submit">
            </div>

        </form>
        <div class="d-flex justify-content-end">
            <div class="p-2">
                <a href="{{ route('otro.solicitar') }}" class="btn btn-dark">Regresar </a>
            </div>

        </div>

    </div>
@endsection

@push('scripts')
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
@endpush

