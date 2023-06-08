@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')

<div class="container justify-content-md-center" style="background-color: rgb(215, 228, 247)">
    <h2 class="text-center p-3 text-secondary text-white" style="background-color: rgb(58, 80, 133)">Usuarios</h2>
    <div style="d-flex justify-content-around; flex-direction:column; justify-content:center; align-items:center" class="col-12 p-5">
        <div class=" d-flex justify-content-between table-responsive">
            <table class="table table-hover table-light">
                <thead class="table-active">
                    <th scope="col" style="display:none"></th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Aval</th>
                    <th scope="col">Dependencia</th>
                    <th scope="col">Correo Aval</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Acceso</th>
                    <th scope="col"></th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td style="display:none">{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->aval }}</td>
                            <td>{{ $user->dependencia }}</td>
                            <td>{{ $user->correoaval }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <form action="{{ route('admin.cambiarRol',$user->id) }}" id="formulario" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <select class="form-select" name="role" aria-label="Default select example">
                                            <option selected></option>
                                            <option value="asignador">Asignador</option>
                                            <option value="revisor">Revisor</option>
                                            <option value="admin">Administrador</option>
                                            <option value="otro">Solicitante</option>
                                            <option value="espera">Sin Acceso</option>
                                        </select>
                                    </div>
                                    <input type="submit" value="Guardar" id="guardar" class="btn btn-warning btn-submit">
                                </form>
                            </td>

                            <td>
                                <a href="{{ route('otro.numeroEdit',$user->id) }}" type="button" class="btn btn-info">Editar</a>
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
