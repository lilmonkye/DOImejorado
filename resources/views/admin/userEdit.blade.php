@extends('layouts.app')

@section('content')

    <div class="container" style="background-color: rgb(215, 228, 247)">
        <h2 class="text-center p-3 text-secondary text-white"  style="background-color: rgb(58, 80, 133)">Usuario</h2>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
            </symbol>
        </svg>
        <div class="alert alert-primary d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
            <div>
                Asegurese de que la información del usuario no contenga errores ortográficos.
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

        <form action="{{ route('admin.updateUser', ['id',$user->id]) }}" id="formulario" method="POST" >
            @csrf
            <div style="d-flex justify-content-around; justify-content:center; align-items:center" >

                <input type="hidden" name="idrevista" value="{{ $user->id }}" class="form-control">

                <div class="mb-3 ">
                    <label for="nombre" class="form-label"> + Nombre</label>
                    <input type="text" value="{!! isset($user->name)?$user->name:old('name') !!}" class="form-control" name="nombre">
                </div>

                <div class="mb-3 form-group">
                    <label for="aval"> + Aval</label>
                    <input type="text" value="{!! isset($user->aval)?$user->aval:old('aval') !!}" class="form-control" name="aval">
                </div>

                <div class="mb-3 form-group">
                    <label for="dependencia"> + Dependencia</label>
                    <input type="text" value="{!! isset($user->dependencia)?$user->dependencia:old('dependencia') !!}" class="form-control" name="dependencia">
                </div>

                <div class="mb-3 ">
                    <label for="correoaval" class="form-label"> + Correo de Aval</label>
                    <input type="url" value="{!! isset($user->correoaval)?$user->correoaval:old('correoaval') !!}" class="form-control" name="correoaval">
                </div>

                <div class="d-flex justify-content-center mb-3 p-3">
                    <input type="submit" value="Registrar" id="registro" class="btn btn-secondary btn-submit">
                </div>
            </div>
        </form>
    </div>
@endsection


