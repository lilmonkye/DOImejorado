@extends('layouts.app')

@section('content')
<div class="container" style="background-color: rgba(215, 228, 247, 0.918)">

    <h2 class="text-center p-3 text-secondary text-white" style="background-color: rgb(58, 80, 133)">Revisores</h2>

    <div style="d-flex justify-content-around; flex-direction:column; justify-content:center; align-items:center" class="col-12 p-5">
        <div class="table-responsive">
            <table class="table table-hover table-light">
                <thead class="table-active">
                    <th scope="col">Nombre</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </thead>
                <tbody>
                    @foreach ($revisores as $revisor)
                        <tr>
                            <td>{{ $revisor->name }}</td>
                            <td></td>
                            <td><a href="{{ route('asignador.asignar',['idrevisor'=>$revisor->id,'idsolicitud'=>$id]) }} " type="button" class="btn btn-warning">Asignar</a></td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        <a href="{{ route('asignador.tsolicitudes') }}" class="btn btn-secondary">Regresar </a>
    </div>
    {{-- <td>{{ $solicitud->observaciones }}</td> --}}
</div>
@endsection
