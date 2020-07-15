@extends('layout') <!-- Extiende del main -->

@section('head') <!-- sustituye esta seccion del head por lo siguiente escrito -->
    <title> Productos Dulces Miguel </title>
@endsection

@section('body') <!-- sustituye esta seccion del body por lo siguiente escrito -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-9">
              <h1>Productos</h1>
            </div>
            <div class="col-sm-12 col-md-3">
                <a href="producto/create" type="button" class="btn btn-success w-100">Agregar producto</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">clave</th>
                    <th scope="col">Codigo de barras</th>
                    <th scope="col">Precio compra</th>
                    <th scope="col">Precio venta</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <th scope="row">{{$producto->id}}</th>
                            <td>{{$producto->nombre}}</td>
                            <td>{{$producto->descripcion}}</td>
                            <td>{{$producto->clave}}</td>
                            <td>{{$producto->codigo_de_barras}}</td>
                            <td>{{$producto->precio_compra}}</td>
                            <td>{{$producto->precio_venta}}</td>
                        </tr> 
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
@endsection