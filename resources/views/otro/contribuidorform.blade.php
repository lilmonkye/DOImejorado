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
        <h2 class="text-center p-3 text-secondary text-white" style="background-color: rgb(58, 80, 133)">Contribuidor</h2>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
            </symbol>
        </svg>
        <div class="alert alert-primary d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
            <div>
                Asegurese de que la información del contribuidor contenga los signos de acentuación y sin errores ortográficos
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

        <form action="{{ route('otro.contribuidor_store', $idarticulo) }}" id="formulario" method="POST">
            @csrf

            <div>
                <input type="hidden" name="idarticulo" value="{!! $articulo->id !!}" class="form-control">

                <div class="row">
                    <div class="col mb-3">
                        <label for="apellido" class="form-lablel">+ Apellido</label>
                        <input type="text" value="{!! isset($contribuidor->apellido)?$contribuidor->apellido:old('apellido') !!}" class="form-control" name="apellido">
                    </div>

                    <div class="col mb-3">
                        <label for="nombre" class="form-lablel">Nombre</label>
                        <input type="text" value="{!! isset($contribuidor->nombre)?$contribuidor->nombre:old('nombre') !!}" class="form-control" name="nombre">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="afiliacion" class="form-lablel">Afiliación</label>
                    <input type="text" value="{!! isset($contribuidor->afiliacion)?$contribuidor->afiliacion:old('afiliacion') !!}" class="form-control" name="afiliacion">
                </div>

                <div class="mb-3">
                    <label for="nombre" class="form-lablel">Seleccione rol del contribuidor</label>
                    <select class="form-select" name="rol" aria-label="Default select example">
                        <option selected></option>
                        <option value="autor">Autor</option>
                        <option value="editor">Editor</option>
                        <option value="chair">Chair</option>
                        <option value="revisor">Revisor</option>
                        <option value="asistente de revisor">Asistente de Revisor</option>
                        <option value="revisor de estadisticas">Revisor de Estadísticas</option>
                        <option value="revisor externo">Revisor Externo</option>
                        <option value="lector">Lector</option>
                        <option value="traductor">Traductor</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="orcid" class="form-lablel">ORCID ID</label>
                    <input type="text" value="{!! isset($contribuidor->orcid)?$contribuidor->orcid:old('orcid') !!}" placeholder="orcid.org/0000-0001-2345-6789" class="form-control" name="orcid">
                </div>

                <div class="mb-3">
                    <label for="nomalternativo" class="form-lablel">Nombre Alternativo</label>
                    <input type="text" value="{!! isset($contribuidor->nomalternativo)?$contribuidor->nomalternativo:old('nombre') !!}" class="form-control" name="nomalternativo">
                </div>

            </div>
            <div class="d-flex justify-content-center mb-3 p-3">
                <input type="submit" value="Registrar" id="registro" class="btn btn-secondary btn-submit">
            </div>
        </form>



    </div>
@endsection
