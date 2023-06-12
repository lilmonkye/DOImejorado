@extends('layouts.app')

@section('content')
<div class="container" style="background-color: rgba(215, 228, 247, 0.918)">

    <h2 class="text-center p-3 text-secondary text-white" style="background-color: rgb(58, 80, 133)">Solicitudes</h2>

    <div style="d-flex justify-content-around; flex-direction:column; justify-content:center; align-items:center" class="col-12 p-5">
        <div class="table-responsive">
            <table class="table table-hover table-light">
                <thead class="table-active">
                    <th scope="col" style="display:none"></th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Estatus</th>
                    <th scope="col">Observaciones</th>
                    <th scope="col">DOI</th>
                </thead>
                <tbody>
                    @foreach ($solicituds as $solicitud)
                        <tr>

                            <td style="display:none">{{ $solicitud->id }}</td>
                            <td>{{ $solicitud->nombre_solicitud }}</td>
                            <td>{{ $solicitud->estatus }}</td>
                            <td>{{ $solicitud->observaciones }}</td>
                            <td>{{ $solicitud->doicreado }}</td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        <a href="{{ route('otro_dashboard') }}" class="btn btn-secondary">Regresar </a>
    </div>
    {{-- <td>{{ $solicitud->observaciones }}</td> --}}
</div>
@endsection
