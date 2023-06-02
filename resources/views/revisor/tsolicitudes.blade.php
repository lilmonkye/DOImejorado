@extends('layouts.app')

@section('content')
<div class="container" style="background-color: rgba(215, 228, 247, 0.918)">

    <h2 class="text-center p-3 text-secondary text-white" style="background-color: rgb(58, 80, 133)">Solicitudes</h2>

    <div style="d-flex justify-content-around; flex-direction:column; justify-content:center; align-items:center" class="col-12 p-5">
        <div class="table-responsive">
            <table class="table table-hover table-light">
                <thead class="table-active">
                    <th scope="col">No Solicitud</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Estatus</th>
                    <th scope="col"></th>
                </thead>
                <tbody>
                    @foreach ($solicituds as $solicitud)
                        <tr>

                            <td>{{ $solicitud->id }}</td>
                            <td>{{ $solicitud->nombre_solicitud }}</td>
                            <td>{{ $solicitud->name}}</td>
                            <td>{{ $solicitud->estatus }}</td>
                            <td>
                                <a href="{{ route('revisor.showsolicitud',$solicitud->id) }}" type="button" class="btn btn-warning">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="p-3">
        <a href="{{ route('revisor_dashboard') }}" class="btn btn-secondary">Regresar </a>
    </div>
</div>
@endsection
