@extends('layouts.app') <!-- Extiende del main -->



@section('content') <!-- sustituye esta seccion del body por lo siguiente escrito -->
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <h1>Crear producto</h1>
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
                <form action="/producto" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input type="file" class="form-control" id="imagen" name="imagen">

                </div>
                    <div class="form-group">    
                        <label for="abreviacion">abreviacion</label>
                        <input type="text" class="form-control" id="abreviacion" name="abreviacion" placeholder="abreviacion">
                    </div>
                    <div class="form-group">    
                        <label for="compra">Precio compra</label>
                        <input type="number" class="form-control" id="compra" name="compra" placeholder="Precio compra">
                    </div>
                    <div class="form-group">    
                        <label for="venta">Precio venta</label>
                        <input type="number" class="form-control" id="venta" name="venta" placeholder="Precio venta">
                    </div>
                    <div class="form-group">    
                        <label for="Cantidad">Cantidad en almacen</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad_almacen" placeholder="Cantidad">
                        <input hidden="true" type="number" class="form-control" id="cantidad" name="cantidad_carro" placeholder="Cantidad" value="0">
                    </div>
                    <button type="submit" class="btn btn-primary col-12 col-md-3 mb-3">Guardar</button>
                    <a href="/producto" class="btn btn-danger col-12 col-md-3 mb-3">cancelar </a>
                </form>
            </div>
        </div>
        
    </div>
@endsection