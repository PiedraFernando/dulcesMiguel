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
                <img class="card-img-top" src="data:image/jpeg;base64,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" alt="">
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
                let cant = prompt("Cuantos productos agregara?");
                $(this).find(".cant").val(cant);
            });
            $(".addCar").submit(function(){
                let cant = prompt("Cuantos productos agregara al carrito?");
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