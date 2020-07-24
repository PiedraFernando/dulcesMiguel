@extends('layouts.app')


@section('content')

<div class="container">
    <h2>Gestion de Categorias <a href="categorias/create"> <button type="button" class="btn btn-success float-right">Agregar Categoria </button></a> </h2>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Categoria</th>
            <th scope="col">Sub Categoria</th>
            <th scope="col">Opciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categorias as $categoria)
            <tr>
                <th scope="row">{{$categoria->id}}</th>
                <td>{{$categoria->categoria}}</td>
                <td>{{$categoria->sub_categoria}}</td>
                <td>

                    <form action="{{route ('categorias.destroy', $categoria->id ) }} " method="POST">
                        <a href="{{ route('categorias.edit', $categoria->id) }}"><button type="button" class="btn btn-primary">Editar</button></a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Esta seguro de eliminar esta Categoria?')" class="btn btn-danger">Eliminar</button>


                    </form>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
