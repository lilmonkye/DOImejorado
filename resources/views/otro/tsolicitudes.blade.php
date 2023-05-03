@extends('layouts.app')

@section('content')
<div class="container" style="background-color: rgba(215, 228, 247, 0.918)">

    <h2 class="text-center p-3 text-secondary text-white" style="background-color: rgb(58, 80, 133)">Solicitudes</h2>

    <div style="d-flex justify-content-around; flex-direction:column; justify-content:center; align-items:center" class="col-12 p-3">
        <div class="d-flex justify-content-between table-responsive">
            <table class="table table-hover table-light">
                <thead class="table-active">
                    <th scope="col"></th>
                    <th scope="col">#</th>
                    <th scope="col">Ticket</th>
                    <th scope="col">Estatus</th>
                </thead>

            </table>
        </div>
        <a href="{{ route('otro_dashboard') }}" class="btn btn-secondary">Regresar </a>
    </div>
</div>
@endsection
