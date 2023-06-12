@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')

<div class="container justify-content-md-center" style="background-color: rgb(215, 228, 247)">
    <h2 class="text-center p-3 text-secondary text-white" style="background-color: rgb(58, 80, 133)">Solicitudes</h2>
    <div style="d-flex justify-content-around; flex-direction:column; justify-content:center; align-items:center" class="col-12 p-5">
        <div class="table-responsive">
            <table class="table table-hover table-light">
                <thead class="table-active">
                    <th scope="col" style="display:none"></th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Usuario</th>
                    <th scope="col"></th>
                </thead>
                <tbody>
                    @foreach ($solicituds as $solicitud)
                        <tr>

                            <td style="display:none">{{ $solicitud->id }}</td>
                            <td>{{ $solicitud->nombre_solicitud }}</td>
                            <td>{{ $solicitud->name}}</td>
                            <td>
                                <a href="{{ route('admin.showsolicitud',$solicitud->id) }}" type="button" class="btn btn-warning">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <div class="p-3">
        <a href="{{ route('admin_dashboard') }}" class="btn btn-secondary" style="margin-left: 40px">Regresar </a>
    </div>
</div>
@endsection

