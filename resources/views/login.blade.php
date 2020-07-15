@extends('main') <!-- Extiende del main -->

@section('head') <!-- sustituye esta seccion del head por lo siguiente escrito -->
    <title> Login Dulces Miguel </title>
@endsection

@section('body') <!-- sustituye esta seccion del body por lo siguiente escrito -->
    <div class="container-fluid bg-dark h-100">
        <div class="row h-100 justify-content-center">
            <div class="col-10 col-md-4 my-auto text-white border rounded">
                <h1 class="text-center"><font face="'Alex Brush', cursive">Dulces Miguel</font></h1>
                <form class="my-3">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" id="usuario" placeholder="usuario">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" placeholder="contraseña">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                </form>
            </div>
        </div>
    </div>
@endsection