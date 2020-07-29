@extends('layouts.app')

@section('content')
<!-- sustituye esta seccion del body por lo siguiente escrito -->
<div class="container">
  <div class="row">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Agregar productos venta
    </button>
    </div>
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
              <table class="table table-bordered data-table" id="Mitabla">
                <thead>
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Abreviación</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad en carrito</th>
                    <th scope="col">Acción</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <div class="table-responsive col-md-12">
      <!-- tabla que deberia recibir los productos del modal al hacer clic en agregar 
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
      </table>-->
 
    </div>
    <div>
      <div class="table-responsive">
              <div class="col-sm-1 col-md-1">
              </div>
              <!-- tabla que se llena y hace busquedas sin cargar la pagina -->
              <form action="/ventas" method="post">
              @csrf
                <table class="table table-bordered data-table" >
                  <thead>
                    <tr>
                      <th scope="col">Producto</th>
                      <th scope="col">Disponibles</th>
                      <th scope="col">Precio</th>
                      <th scope="col">Cantidad</th>
                      <th scope="col">Total</th>
                      <th scope="col">Quitar</th>
                    </tr>
                  </thead>
                    <tbody id="MiVenta">
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success" >Realizar venta</button>
              </form>
            </div>
          </div>
    </div>

  @push('scripts')
  <script>
    /*función que a traves de la ruta escrita , imprime los datos por medio de ajax  
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
    */

    $(function() {
      var table = $('#Mitabla').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('api/ventas') }}",
        columns: [{
          data: 'nombre'
          },
          {
            data: 'abreviacion'
          },
          {
            data: 'precio_venta'
          },
          {
            data: 'cantidad_carro'
          },
          {
            data: 'btn'
          },

        ],
        language: {
          'url': '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        }
      });
    });
     
  </script>
  @endpush
  <script >
      function add(id){
        let cantidad = prompt("cantidad a vender, si dios quiere, juasjuas");
        datos = {"id":id};
        $.ajax({
          type: "get",
          url: "/ventas/search",
          data: datos,
          success: function (response) {
            let producto = JSON.parse(response)
            console.log(producto);
            $("#MiVenta").append(
              "<tr>"+
              "<th>"+ producto["nombre"] + "<input class='form-control cont' type='text' name='id[]' value="+producto["id"]+" hidden='true'>" +"</th>"+
              "<th>"+ producto["cantidad_carro"] +"</th>"+
              "<th>"+ producto["precio_venta"] +"</th>"+
              "<th>"+ "<input class='form-control cont' type='text' name='cantidad[]' value="+cantidad+">" +"</th>"+
              "<th>"+ producto["precio_venta"]*cantidad +"</th>"+
              "</tr>"
              );
          }
        });
      }
  </script>
  
  @endsection