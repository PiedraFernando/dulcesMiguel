@extends('layouts.app')

@section('content')
<div class="container">
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Agregar productos venta
  </button>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Buscar producto</h5>
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
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <form action="/ventas" method="post">
      @csrf
      <table class="table table-bordered data-table" >
        <thead>
          <tr>
            <th scope="col">Producto</th>
            <th scope="col">Disponibles</th>
            <th scope="col">Precio</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Quitar</th>
          </tr>
        </thead>
        <tbody id="MiVenta">
        </tbody>
      </table>
      <div class="form-group d-inline">
        <label for="total">Total: $</label>
        <input id="total" class="form-control" type="text" name="total" value="0">
      </div>
      <button type="submit" class="btn btn-success" >Realizar venta</button>
    </form>
  </div>
</div> 
  @push('scripts')
  <script>
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
        let cantidad = prompt("cantidad a vender");
        if(cantidad!=null){
          datos = {"id":id};
          $.ajax({
            type: "get",
            url: "/ventas/search",
            data: datos,
            success: function (response) {
              let producto = JSON.parse(response)
              subtotal = producto["precio_venta"]*cantidad;
              $("#MiVenta").append(
                "<tr>"+
                "<th>"+ producto["nombre"] + "<input class='form-control cont' type='text' name='id[]' value="+producto["id"]+" hidden='true'>" +"</th>"+
                "<th>"+ producto["cantidad_carro"] +"</th>"+
                "<th class='precio'>"+ producto["precio_venta"] +"</th>"+
                "<th>"+ "<input class='form-control cont' type='text' name='cantidad[]' value="+cantidad+">" +"</th>"+
                "<th class='sub'>"+ subtotal +"</th>"+
                "<th>"+ "<input type='button' class='borrar btn-danger btn-sm' value='Eliminar' /></div>"+ "</th>"+
                "</tr>"
                );
                $("#total").val(parseInt($("#total").val())+subtotal);
            }
          });
        }
      }
  </script>
  <script>
    $(document).on('click', '.borrar', function (event) {
        event.preventDefault();
        $(this).closest('tr').remove();
    });
    $(document).on('change', '.cont', function (event) {
      sub = $(this).closest("tr").find(".sub").html();
      $("#total").val(parseInt($("#total").val())-sub);

      nuevoSub = $(this).closest("tr").find(".precio").html() * $(this).val();
      $(this).closest("tr").find(".sub").html(nuevoSub);
      $("#total").val(parseInt($("#total").val())+nuevoSub);
    });
</script>

@endsection