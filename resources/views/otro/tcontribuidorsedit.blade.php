@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')

<div class="container justify-content-md-center" style="background-color: rgb(215, 228, 247)">
    <h2 class="text-center p-3 text-secondary text-white" style="background-color: rgb(58, 80, 133)">Contribuidores Registrados</h2>
    <div style="d-flex justify-content-around; flex-direction:column; justify-content:center; align-items:center" class="col-12 p-5">
        <div class=" d-flex justify-content-between table-responsive">
            <table class="table table-hover table-light">
                <thead class="table-active">
                    <th scope="col" style="display:none"></th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Afiliación</th>
                    <th scope="col">ORCID ID</th>
                    <th scope="col">Nombre Alternativo</th>
                    <th scope="col">Rol</th>
                    <th scope="col"></th>
                </thead>
                <tbody>
                    @foreach ($contribuidors as $contribuidor)
                        <tr>
                            <td style="display:none">{{ $contribuidor->id }}</td>
                            <td>{{ $contribuidor->nombre }}</td>
                            <td>{{ $contribuidor->apellido }}</td>
                            <td>{{ $contribuidor->afiliacion }}</td>
                            <td>{{ $contribuidor->orcid }}</td>
                            <td>{{ $contribuidor->nomalternatico }}</td>
                            <td>{{ $contribuidor->rol }}</td>
                            <td>
                                <a href="{{ route('otro.contribuidorEdit',$contribuidor->id) }}" type="button" class="btn btn-warning">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
    <div class="p-3">
        <a href="{{ route('otro.registros') }}" class="btn btn-secondary" style="margin-left: 40px">Regresar </a>
    </div>
</div>
@endsection
