@extends('layouts.app')

@section('head')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js" integrity="sha512-pw+QdMj3fUPyAL51XGxJx1CrRt1n+VZgJrvymwLb7+uajP8eV7ocnmXsJxCO7SPHPKr+UnlV7C2kjLwDbl7GjQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@endsection

@section('content')

    <div class="container" style="background-color: rgb(215, 228, 247)">
        <h2 class="text-center p-3 text-secondary text-white"  style="background-color: rgb(58, 80, 133)">Artículo para número</h2>
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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('otro.articulo_storeconnumero', $idnumero) }}" id="formulario" method="POST" >
            @csrf
            <div style="d-flex justify-content-around; justify-content:center; align-items:center" >

                <input type="hidden" name="idnumero" value="{{ $numero->id }}" class="form-control">

                <div class="mb-3 ">
                    <label for="titulo" class="form-label"> + Título del Artículo</label>
                    <input type="text" value="{{ isset($articulo->titulo)?$articulo->titulo:old('titulo')}}" class="form-control" name="titulo">
                </div>

                <label for="doi" class="form-label"> ¿Este artículo cuenta con DOI?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="bandoi" id="doi_si">
                    <label class="form-check-label" for="doi_si">Si</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="bandoi" id="doi_no">
                    <label class="form-check-label" for="doi_no">No</label>
                </div>

                <div class="mb-3 form-group">
                    <label for="doi">DOI:</label>
                    <input type="text" value="{{ isset($articulo->doi)?$articulo->doi:old('doi')}}" class="form-control" name="doi" id="doi" disabled>
                </div>

                <div class="mb-3 ">
                    <label for="url" class="form-label"> + URL</label>
                    <input type="url" placeholder="https://ejemplo.com" value="{{ isset($articulo->url)?$articulo->url:old('url')}}" class="form-control" name="url">
                </div>

                <h5>Según sea el caso de su revista llenar la fecha de publicación impresa, digital o ambas (Aa-Mm-Dd).</h5>
                <div class="row">
                    <div class="col mb-3">
                        <label for="fechaimpr" class="form-label"> + Fecha de Publicación Impresa</label>
                        <input class="form-control"  type="date" value="{{ old('fechaimpr')}}" id="fechaimpr" name="fechaimpr">
                    </div>

                    <div class="col mb-3">
                        <label for="fechadig" class="form-label">  + Fecha de Publicación Digital</label>
                        <input class="form-control" type="date" value="{{ old('fechadig')}}" id="fechadig" name="fechadig">
                    </div>
                </div>

                <div class="mb-3 ">
                    <label for="primerpag" class="form-label"> Primera página</label>
                    <input type="number" value="{{ isset($articulo->primerpag)?$articulo->primerpag:old('primerpag')}}" class="form-control" name="primerpag">
                </div>

                <div class="mb-3 ">
                    <label for="ultimapag" class="form-label"> Última página</label>
                    <input type="number" value="{{ isset($articulo->ultimapag)?$articulo->ultimapag:old('ultimapag')}}" class="form-control" name="ultimapag">
                </div>

                <div class="d-flex justify-content-center p-3">
                    <input type="submit" value="Registrar" id="registro" class="btn btn-secondary btn-submit">
                </div>
            </div>
        </form>
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

    <script>
        flatpickr("input[type=datetime-local]");
    </script>

    <script>
        config = {
            enableTime: true,
            dateFormat: 'Y-m-d H:i',
        }
        flatpickr("input[type=datetime-local]", config);
    </script>

@endpush
