@extends('layout') <!-- Extiende del main -->

@section('head') <!-- sustituye esta seccion del head por lo siguiente escrito -->
    <title> Productos Dulces Miguel </title>
@endsection

@section('body') <!-- sustituye esta seccion del body por lo siguiente escrito -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-3">
              <h1>Productos</h1>
            </div>
            <form action="/producto" class="form-inline ol-sm-12 col-md-4">
                <input class="form-control w-75" type="search" name="search" placeholder="Nombre, codigo o codigo de barras del producto" aria-label="Search">
                <button class="btn btn-outline-success w-25" type="submit">Buscar</button>
            </form>
            <div class="col-sm-12 col-md-3">
                <a href="/producto/faltantes" type="button" class="btn btn-warning w-100">Productos faltantes</a>
            </div>
            <div class="col-sm-12 col-md-2">
                <a href="/producto/create" type="button" class="btn btn-success w-100">Agregar producto</a>
            </div>
        </div>
        @if($search ?? '')
            <h6>
                <div class="alert alert-primary" role="alert">
                    los resultados de la busqueda de '{{$search}}' son:
                </div>
            </h6>
        @endif
        @if($faltantes ?? '')
            <h6>
                <div class="alert alert-warning" role="alert">
                    los productos faltantes son:
                </div>
            </h6>
        @endif
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
                    <th scope="col">Cantidad actual</th>
                    <th scope="col">Opciones</th>
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
                            <td>{{$producto->cantidad}}</td>
                            <td>
                                <a href="{{route('producto.edit', $producto->id)}}" type="button" class="btn btn-primary">Modificar</a>
                                <form action="{{route('producto.destroy', $producto->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Esta seguro de eliminar este elemento?')" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr> 
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
    
@endsection