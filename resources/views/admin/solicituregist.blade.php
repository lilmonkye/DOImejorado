@extends('layouts.app')

@section('content')
<div class="conteiner justify-content-md-center">
    <div style="d-flex justify-content-around; flex-direction:column; justify-content:center; align-items:center" class="col-12 p-5">
        <div class="table-responsive d-flex justify-content-between">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <th scope="col"></th>
                    <th scope="col">Número de Solicitud</th>
                    <th scope="col">Ticket</th>
                    <th scope="col">Estatus</th>
                </thead>

            </table>
        </div>
        <a href="{{ route('admin_dashboard') }}" class="btn btn-secondary">Regresar </a>
    </div>
</div>
@endsection
