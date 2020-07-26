@extends('layouts.app') 
@extends('layout') 


@section('content')
 <!-- sustituye esta seccion del body por lo siguiente escrito -->
    <div class="container">
        <div class="row">
        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Agregar productos venta
</button>

<!-- modal para cargar los productos y entonces enviarlos a la tabla de afuera de ventas -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="table-responsive">
            <div class="col-sm-1 col-md-1">
            </div>
            <!-- tabla que se llena y hace busquedas sin cargar la pagina -->
            <table class="table table-bordered data-table" >
                <thead>
                <tr>
                    <th scope="col">nombre</th>
                    <th scope="col">descripción</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Acción</th>
                    

                </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
    
<div class="table-responsive col-md-12">
<!-- tabla que deberia recibir los productos del modal al hacer clic en agregar -->
<table class="table table-bordered table-striped table-sm" id="tablaAlineamientos">
<thead>
<tr>
<th>Quitar</th>
<th>Producto</th>
<th>Precio</th>
<th>Cantidad</th>
</tr>
</thead>
<tbody>

<tbody>
</table>
</div>
<div>
<button type="button" class="btn btn-success" data-dismiss="modal">Realizar venta</button></div>
    </div>
    @push('scripts')
    <script>  
    //función que a traves de la ruta escrita , imprime los datos por medio de ajax  
 $(function(){
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('api/ventas') }}",
        columns: [
            {data: 'nombre'},
            {data: 'descripcion'},
            {data: 'precio_venta'},
            {data: 'btn'},
            
        ],
        
        language: {
  'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'

}
    });
    });

  </script>
  @endpush
    @endsection