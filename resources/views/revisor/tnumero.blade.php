@extends('layouts.app')


@section('content')


<div class="container justify-content-md-center" style="background-color: rgb(215, 228, 247)">
    <h2 class="text-center p-3 text-secondary text-white" style="background-color: rgb(58, 80, 133)">Números Registrados</h2>

    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
    </svg>
    <div class="alert alert-primary d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
        <div class="col p-3">
            <div class="row">
                Asegurese de que las observaciones se encuentren completas al dar "Guardar" se enviara el comentario.
            </div>
            <div class="row">
                Presionar "Aprobar" únicamente si la información proporcionada es correcta y no necesita correcciones.
            </div>
        </div>
    </div>

    <div style="d-flex justify-content-around; flex-direction:column; justify-content:center; align-items:center" class="col-12 p-3">

        <div class=" d-flex justify-content-between table-responsive">
            <table class="table table-hover table-light">
                <thead class="table-active">
                    <th scope="col">#</th>
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

        <div class=" d-flex justify-content-between table-responsive">
            <table class="table table-hover table-light">
                <thead class="table-active">
                    <th scope="col"></th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Afiliación</th>
                    <th scope="col">ORCID ID</th>
                    <th scope="col">Nombre Alternativo</th>
                    <th scope="col">Rol</th>
                </thead>
                <tbody>
                    @foreach ($contribuidores as $contribuidor)
                        <tr>
                            <td>{{ $contribuidor->id }}</td>
                            <td>{{ $contribuidor->nombre }}</td>
                            <td>{{ $contribuidor->apellido }}</td>
                            <td>{{ $contribuidor->afiliacion }}</td>
                            <td>{{ $contribuidor->orcid }}</td>
                            <td>{{ $contribuidor->nomalternatico }}</td>
                            <td>{{ $contribuidor->rol }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-light">
                <thead class="table-active">
                    <th scope="col">Observaciones</th>
                </thead>
                <tbody>
                    @foreach ($solicituds as $solicitud)
                        <tr>

                            <td>{{ $solicitud->observaciones }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center p-3 ">

            <a href="#" class="btn btn-success btnAbrirModal">Aprobar</a>

        </div>

    </div>

    <form action="{{ route('revisor.guardar-numero',$numero->id) }}" id="formulario" method="POST">
        @csrf
        <div style="d-flex justify-content-around; justify-content:center; align-items:center" >
            <div class="mb-3">
                <label for="observaciones" class="form-label"> Observaciones</label>
                <textarea class="form-control" name="observaciones" rows="8">{!! isset($solicitud->observaciones) ? $solicitud->observaciones : old('observaciones') !!}</textarea>
            </div>
            <div class="d-flex justify-content-center mb-3 p-3">
                <input type="submit" value="Guardar Observación" id="registro" class="btn btn-warning btn-submit">
            </div>
        </div>

    </form>

    <div class="p-3">
        <a href="{{ route('revisor.tsolicitudes') }}" class="btn btn-secondary" style="margin-left: 40px">Regresar </a>
    </div>
</div>
@endsection
