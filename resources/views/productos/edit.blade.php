@extends('layouts.app') <!-- Extiende del main -->



@section('content')  <!-- sustituye esta seccion del body por lo siguiente escrito -->
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <h1>Modificar producto</h1>
            </div>
        </div>
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col">
                <form action="{{route('producto.update', $producto->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$producto->nombre}}">
                    </div>
                    <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input type="file" class="form-control" id="imagen" name="imagen" placeholder="imagen">
                </div>
                    <div class="form-group">    
                        <label for="descripcion">Abreviación</label>
                        <input type="text" class="form-control" id="abreviacion" name="abreviacion" placeholder=""  value="{{$producto->abreviacion}}">
                    </div>
                    <div class="form-group">    
                        <label for="compra">Precio compra</label>
                        <input type="number" class="form-control" id="compra" name="compra" placeholder="Precio compra" value="{{$producto->precio_compra}}">
                    </div>
                    <div class="form-group">    
                        <label for="venta">Precio venta</label>
                        <input type="number" class="form-control" id="venta" name="venta" placeholder="Precio venta" value="{{$producto->precio_venta}}">
                    </div>
                    <div class="form-group">    
                        <label for="Cantidad">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad_almacen" name="cantidad_almacen" placeholder="cantidad_almacen" value="{{$producto->cantidad_almacen}}">
                    </div>
                    <div class="form-group">    
                        <label for="Cantidad">Cantidad en carro</label>
                        <input type="number" class="form-control" id="cantidad_carro" name="cantidad_carro" placeholder="cantidad_carro" value="{{$producto->cantidad_carro}}">
                    </div>
                    <button type="submit" class="btn btn-primary col-12 col-md-3 mb-3">Guardar cambios</button>
                    <a href="/producto" class="btn btn-danger col-12 col-md-3 mb-3">cancelar</a>
                </form>
            </div>
        </div>
        
    </div>
    @endsection