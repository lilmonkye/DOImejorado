@extends('layouts.app')

@section('content')

<div class="conteiner justify-content-md-center" style="background-color: rgb(215, 228, 247)">
    <h2 class="text-center p-3 text-secondary text-dark" style="background-color: rgb(232, 239, 255)">Revistas Registradas</h2>
    <div style="d-flex justify-content-around; flex-direction:column; justify-content:center; align-items:center" class="col-12 p-5">
        <div class="table-responsive d-flex justify-content-between">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <th scope="col"></th>
                    <th scope="col">Título</th>
                    <th scope="col">Título Abreviado</th>
                    <th scope="col">DOI</th>
                    <th scope="col">URL</th>
                    <th scope="col">Issn impreso</th>
                    <th scope="col">Issn electronico</th>
                    <th scope="col">Idioma</th>
                    <th scope="col"></th>
                </thead>
                <tbody>
                    @foreach ($revistas as $revista)
                        <tr>
                            <td>{{ $revista->id }}</td>
                            <td>{{ $revista->titulo }}</td>
                            <td>{{ $revista->tituloabr }}</td>
                            <td>{{ $revista->doi }}</td>
                            <td>{{ $revista->url }}</td>
                            <td>{{ $revista->issnimp }}</td>
                            <td>{{ $revista->issnelec }}</td>
                            <td>{{ $revista->idioma }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>

    <a href="{{ route('otro_dashboard') }}" class="btn btn-secondary" style="margin-left: 40px">Regresar </a>
</div>
@endsection
