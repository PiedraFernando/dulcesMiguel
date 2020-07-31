@extends('layouts.app')
<!-- Extiende del main -->

@section('content')
<!-- sustituye esta seccion del body por lo siguiente escrito -->
<div class="container">
    <div class="row mb-3">
        <div class="col">
            <h1>Total ventas</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive" id="tab">
                <div class="col-sm-1 col-md-1">
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">fecha</th>
                            <th scope="col">total </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventas as $venta)
                        <tr>
                            <th scope="row">{{$venta->fecha}}</th>
                            <td>${{$venta->total}}</td>
                            @endforeach

                    </tbody>
                </table>
            </div>
            <div class="table-responsive" id="tab2">
                <div class="col-sm-1 col-md-1">
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#Venta</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detallesVentas as $detalle)
                        <tr>
                            <th scope="row">{{$detalle->idVenta}}</th>
                            <td>{{$productos[$detalle->idProducto-1]->nombre}}</td>
                            <td>${{$detalle->precio}}</td>
                            <td>{{$detalle->cantidad}}</td>
                            <td>${{$detalle->cantidad*$detalle->precio}}</td>
                            @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection