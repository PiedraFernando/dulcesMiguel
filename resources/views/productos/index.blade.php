@extends('layouts.app') 


@section('content')
 <!-- sustituye esta seccion del body por lo siguiente escrito -->
    <div class="container">
        <div class="row">
           
            <div class="col-sm-12 col-md-2">
              <h1>Productos</h1>
            </div>
            <form action="/producto" class="form-inline ol-sm-12 col-md-4">
                <input class="form-control w-75" type="search" name="search" placeholder="Nombre, código o código de barras del producto" aria-label="Search">
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
        <div class="row">
            <div class="col-12 col-md-6">
                <button type="button" id="tabla" class="btn btn-primary" style="width: 99%">Modo tabla</button>
            </div>
            <div class="col-12 col-md-6">
                <button type="button" id="producto" class="btn btn-primary" style="width: 99%">Modo productos</button>
            </div>
        </div>
        <div class="table-responsive" id="tab">
            <div class="col-sm-1 col-md-1">
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">abreviacion</th>
                    <th scope="col">Precio compra</th>
                    <th scope="col">Precio venta</th>
                    <th scope="col">Cantidad almacen</th>
                    <th scope="col">Cantidad en carrito</th>
                    <th scope="col">Opciones</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <th scope="col">#</th>
                            <th scope="row">{{$producto->id}}</th>
                            <td>{{$producto->nombre}}</td>
                            <td>{{$producto->abreviacion}}</td>
                            <td>{{$producto->precio_compra}}</td>
                            <td>{{$producto->precio_venta}}</td>
                            <td>{{$producto->cantidad_almacen}}</td>
                            <td>{{$producto->cantidad_carro}}</td>
                            <td>
                                <a href="{{route('producto.edit', $producto->id)}}" type="button" class="btn btn-primary"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
                                    <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
                                  </svg></a>
                                <form class="d-inline add" action="/producto/add" method="POST">
                                    @csrf
                                    <input hidden="true" type="text" name="id" value="{{$producto->id}}" >
                                    <input hidden="true" type="text" name="cantidad" class="cant" value="">
                                    <button type="submit"  class="btn btn-warning"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
                                        <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
                                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        </svg></button>
                                </form>
                                <form class="d-inline addCar" action="/producto/addCar" method="POST">
                                    @csrf
                                    <input hidden="true" type="text" name="id" value="{{$producto->id}}" >
                                    <input hidden="true" type="text" name="cantidad" class="cant" value="">
                                    <button type="submit"  class="btn btn-info"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-box-seam" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                                        </svg></button>
                                </form>
                                <form class="d-inline" action="{{route('producto.destroy', $producto->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Esta seguro de eliminar este elemento?')" class="btn btn-danger"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
                                        <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
                                      </svg></button>
                                </form>
                            </td>
                        </tr> 
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
    <div class="row" id="carta">
        @foreach ($productos as $producto)
        <div class="col-12 col-md-3">
            <div class="card border-primary">
                <img class="card-img-top" src="imagenes/{{$producto->imagen}}" alt="" width="220" height="220" >
                <div class="card-body">
                    <h4 class="card-title w-100">Nombre: {{$producto->nombre}}</h4> 
                    <h4 class="card-title w-100">Cantidad en almacen: {{$producto->cantidad_almacen}}</h4> 
                    <h4 class="card-title w-100">Cantidad en carro: {{$producto->cantidad_carro}}</h4> 
                    <a href="{{route('producto.edit', $producto->id)}}" type="button" class="btn btn-primary"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
                        <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
                      </svg></a>
                    <form class="d-inline add" action="/producto/add" method="POST">
                        @csrf
                        <input hidden="true" type="text" name="id" value="{{$producto->id}}" >
                        <input hidden="true" type="text" name="cantidad" class="cant" value="">
                        <button type="submit"  class="btn btn-warning"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
                            <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            </svg></button>
                    </form>
                    <form class="d-inline addCar" action="/producto/addCar" method="POST">
                        @csrf
                        <input hidden="true" type="text" name="id" value="{{$producto->id}}" >
                        <input hidden="true" type="text" name="cantidad" class="cant" value="">
                        <button type="submit"  class="btn btn-info"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-box-seam" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                            </svg></button>
                    </form>
                    <form class="d-inline" action="{{route('producto.destroy', $producto->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Esta seguro de eliminar este elemento?')" class="btn btn-danger"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
                            <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
                          </svg></button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <script >
        $("#carta").show();
        $("#tab").hide();
        $(document).ready(function () {
            $(".add").submit(function(){
                let cant = prompt("¿Cuántos productos agregará?");
                $(this).find(".cant").val(cant);
            });
            $(".addCar").submit(function(){
                let cant = prompt("¿Cuántos productos agregará al carrito?");
                $(this).find(".cant").val(cant);
            });
            $("#tabla").click(function () {  
                $("#carta").hide();
                $("#tab").show();
            });
            $("#producto").click(function () {  
                $("#carta").show();
                $("#tab").hide();
            });
        });
    </script>
    @endsection