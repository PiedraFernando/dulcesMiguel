@extends('layout') <!-- Extiende del main -->

@section('head') <!-- sustituye esta seccion del head por lo siguiente escrito -->
    <title> Productos Dulces Miguel </title>
@endsection

@section('body') <!-- sustituye esta seccion del body por lo siguiente escrito -->
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <h1>Crear producto</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form action="/producto" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group">    
                        <label for="descripcion">Descripción</label>
                        <textarea type="text" class="form-control" id="descripcion" placeholder="descripción"></textarea>
                    </div>
                    <div class="form-group">    
                        <label for="clave">Clave</label>
                        <input type="text" class="form-control" id="clave" placeholder="Clave">
                    </div>
                    <div class="form-group">    
                        <label for="codigo">Codigo de barras</label>
                        <input type="number" class="form-control" id="codigo" placeholder="Codigo de barras">
                    </div>
                    <div class="form-group">    
                        <label for="compra">Precio compra</label>
                        <input type="number" class="form-control" id="compra" placeholder="Precio compra">
                    </div>
                    <div class="form-group">    
                        <label for="venta">Precio venta</label>
                        <input type="number" class="form-control" id="venta" placeholder="Precio venta">
                    </div>
                    <button type="submit" class="btn btn-primary col-12 col-md-3 mb-3">Guardar</button>
                </form>
            </div>
        </div>
        
    </div>
@endsection