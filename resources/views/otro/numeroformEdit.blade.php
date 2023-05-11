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
        <h2 class="text-center p-3 text-secondary text-white" style="background-color: rgb(58, 80, 133)">Número / Issue</h2>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
            </symbol>
        </svg>
        <div class="alert alert-primary d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
            <div>
                Asegurese de que la información del número contenga los signos de acentuación y los datos se encuentren en el idioma de publicación
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

        <form action="{{ route('otro.numeroUpdate',['id' => $numero->id]) }}" id="formulario" method="POST" >
            @csrf
            <div style="d-flex justify-content-around; justify-content:center; align-items:center" >

                <div class="mb-3 ">
                    <label for="numero" class="form-label"> + Número</label>
                    <input type="text" value="{!! isset($numero->numero)?$numero->numero:old('numero')!!}" class="form-control" name="numero">
                </div>

                <div class="mb-3 ">
                    <label for="titulo" class="form-label"> Título del Número</label>
                    <input type="text" value="{!! isset($numero->titulo)?$numero->titulo:old('titulo')!!}" class="form-control" name="titulo">
                </div>

                <div class="form-group mb-3">
                    <label for="doi">DOI:</label>
                    <input type="text" value="{!! isset($numero->doi)?$numero->doi:old('doi')!!}" class="form-control" name="doi" id="doi" disabled>
                </div>

                <div class="mb-3 ">
                    <label for="url" class="form-label">  URL</label>
                    <input type="url" value="{!! isset($numero->url)?$numero->url:old('url')!!}" class="form-control" name="url">
                </div>

                <div class="row">
                    <div class="col mb-3 ">
                        <label for="fechaimpr" class="form-label"> + Fecha de Publicación Impresa</label>
                        <input class="form-control"  type="date" value="{!! isset($numero->fechaimpr)?$numero->fechaimpr:old('fechaimpr')!!}" id="fechaimpr" name="fechaimpr">
                    </div>

                    <div class="col mb-3">
                        <label for="fechadig" class="form-label">  + Fecha de Publicación Digital</label>
                        <input class="form-control" type="date" value="{!! isset($numero->fechadig)?$numero->fechadig:old('fechadig')!!}" id="fechadig" name="fechadig">
                    </div>
                </div>

                <div class="mb-3 ">
                    <label for="numespecial" class="form-label"> Número especial</label>
                    <input type="text" value="{!! isset($numero->numespecial)?$numero->numespecial:old('primerpag')!!}" class="form-control" name="numespecial">
                </div>

                <div class="row">
                    <div class="col mb-3">
                        <label for="volumen" class="form-label"> Volumen</label>
                        <input type="number" value="{!! isset($numero->volumen)?$numero->volumen:old('volumen')!!}" class="form-control" name="ultimapag">
                    </div>

                    <div class="col mb-3">
                        <label for="volumendoi" class="form-label"> DOI del volumen</label>
                        <input type="text" value="{!! isset($numero->volumendoi)?$numero->volumendoi:old('volumendoi')!!}" class="form-control" name="doi" id="doi">
                    </div>

                    <div class="col mb-3">
                        <label for="volumenurl" class="form-label">  URL del volumen</label>
                        <input type="url" value="{!! isset($numero->volumenurl)?$numero->volumenurl:old('volumenurl')!!}" class="form-control" name="volumenurl">
                    </div>
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
