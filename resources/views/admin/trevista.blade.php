@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')

<div class="container justify-content-md-center" style="background-color: rgb(215, 228, 247)">
    <h2 class="text-center p-3 text-secondary text-white" style="background-color: rgb(58, 80, 133)">Revistas Registradas</h2>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
    </svg>
    <div class="alert alert-primary d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
        <div>
            Asegurese de que el DOI se encuentre sin errores al dar "Guardar" se finalizara la solicitud.
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
    <div style="d-flex justify-content-around; flex-direction:column; justify-content:center; align-items:center" class="col-12 p-5">
        <div class=" d-flex justify-content-between table-responsive">
            <table class="table table-hover table-light">
                <thead class="table-active">
                    <th scope="col" style="display:none"></th>
                    <th scope="col">Título</th>
                    <th scope="col">Título Abreviado</th>
                    <th scope="col">DOI</th>
                    <th scope="col">URL</th>
                    <th scope="col">Issn impreso</th>
                    <th scope="col">Issn electronico</th>
                    <th scope="col">Idioma</th>

                </thead>
                <tbody>
                    @foreach ($revistas as $revista)
                        <tr>
                            <td style="display:none">{{ $revista->id }}</td>
                            <td>{{ $revista->titulo }}</td>
                            <td>{{ $revista->tituloabr }}</td>
                            <td>{{ $revista->doi }}</td>
                            <td>{{ $revista->url }}</td>
                            <td>{{ $revista->issnimp }}</td>
                            <td>{{ $revista->issnelec }}</td>
                            <td>{{ $revista->idioma }}</td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>

    <form action="{{ route('admin.guardarDoirev',$revista->id) }}" id="formulario" method="POST">
        @csrf
        <div style="d-flex justify-content-around; justify-content:center; align-items:center" >
            <div class="mb-3 form-group">
                <label for="doi">DOI:</label>
                <input type="text" value="{!! isset($solicitud->doi)?$solicitud->doi:old('doi') !!}" class="form-control" name="doi" id="doi">
            </div>

            <div class="d-flex justify-content-center mb-3 p-3">
                <input type="submit" value="Guardar" id="guardar" class="btn btn-warning btn-submit">
            </div>
        </div>

    </form>

    <div class="p-3">
        <a href="{{ route('admin.solicitudoi') }}" class="btn btn-secondary" style="margin-left: 40px">Regresar </a>
    </div>
</div>
@endsection
