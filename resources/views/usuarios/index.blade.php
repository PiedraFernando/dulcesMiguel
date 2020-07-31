@extends('layouts.app')


@section('content')

<div class="container">
  <h2>Gestion de usuarios <a href="usuarios/create"> <button type="button" class="btn btn-success float-right">Agregar Usuario </button></a> </h2>
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Email</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <th scope="row">{{$user->id}}</th>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>

          <form action="{{route ('usuarios.destroy', $user->id ) }} " method="POST">
            <a href="{{ route('usuarios.edit', $user->id) }}"><button type="button" class="btn btn-primary">Editar</button></a>
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('¿Esta seguro de eliminar este usuario?')" class="btn btn-danger">Eliminar</button>


          </form>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>



@endsection