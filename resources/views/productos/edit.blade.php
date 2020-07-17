@extends('layout') <!-- Extiende del main -->

@section('head') <!-- sustituye esta seccion del head por lo siguiente escrito -->
    <title> Productos Dulces Miguel </title>
@endsection

@section('body') <!-- sustituye esta seccion del body por lo siguiente escrito -->
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
                <form action="{{route('producto.update', $producto->id)}}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$producto->nombre}}">
                    </div>
                    <div class="form-group">    
                        <label for="descripcion">Descripción</label>
                        <textarea type="text" class="form-control" id="descripcion" name="descripcion" placeholder="descripción">{{$producto->descripcion}}</textarea>
                    </div>
                    <div class="form-group">    
                        <label for="clave">Clave</label>
                        <input type="text" class="form-control" id="clave" name="clave" placeholder="Clave" value="{{$producto->clave}}">
                    </div>
                    <div class="form-group">    
                        <label for="codigo">Codigo de barras</label>
                        <input type="number" class="form-control" id="codigo" name="codigo" placeholder="Codigo de barras" value="{{$producto->codigo_de_barras}}">
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
                        <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad" value="{{$producto->cantidad}}">
                    </div>
                    <button type="submit" class="btn btn-primary col-12 col-md-3 mb-3">Guardar cambios</button>
                    <a href="/producto" class="btn btn-danger col-12 col-md-3 mb-3">cancelar</a>
                </form>
            </div>
        </div>
        
    </div>
@endsection