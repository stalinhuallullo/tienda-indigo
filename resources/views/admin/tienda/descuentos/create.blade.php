@extends ('admin.layouts.master')

@section ('content')

<div class="container-fluid">

  <form id="create_obra_form" method="POST" action="{{ route('admin.descuentos.store') }}">
      {{ csrf_field() }}
      <input type="hidden" name="preview" value="false">
      <div class="page-head">
        <h2 class="page-title float-left">Descuentos </h2>
        <div class="page-bar toolbarBox">
          <ul id="toolbar-nav" class="nav nav-pills float-right">
              <li>
                  <a class="btn btn-default btn-action" href="{{ route('admin.descuentos.index') }}">Cancelar</a>
              </li>
              <li>
                  <button class="btn btn-primary btn-action" type="submit" id="enviar" disabled>Guardar</button>
              </li>
          </ul>
        </div>

      </div>

      <div class="page-date">
          <div class="row">
            <div class="col-md-12"><small></small></div>
          </div>
      </div>

      @include('admin.layouts.errors')
      <!-- card -->
        <div class="card my-3">
            <div class="card-body">

            <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>SKU</th>
                    <th>Imagen</th>
                    <th>Nombres</th>
                    <th>Stock</th>
                    <th>Tipo</th>
                    <!-- <th>Artista</th> -->
                    <th>Precio</th>
                    <th>Descuento %</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $now=Carbon\carbon::now();
                        $mindate=Carbon\carbon::parse($now)->format('Y-m-d');
                        $mindate2=Carbon\carbon::parse($now->addDays(1))->format('Y-m-d');
                    @endphp
                    
                    @foreach ($productos as $producto)
                    <tr id="prod{{ $producto->id }}">
                    <td>{{ $producto->sku }}</td>
                    <td>
                        @if ($producto->img)
                        <img src="/uploads/products/80x80_{{ $producto->img }}" alt="" height="80" width="80" style="object-fit: cover;">
                        @else
                        <img class="img-list-default" alt="">
                        @endif

                    </td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>{{ ($producto->tipo['nombre']) ? $producto->tipo['nombre'] : 'Ninguno' }}</td>
                    <!-- <td>{{-- ($producto->artista['nombres']) ? $producto->artista['nombres'] : 'Ninguno' --}}</td> -->
                    <td id="newprecio{{ $producto->id }}">S/.{{ $producto->precio }}</td>
                    <td>                        
                        <input 
                            type="hidden" 
                            name="producto[{{ $producto->id }}]"                           
                            id="precio{{ $producto->id }}"
                            >
                        <input 
                          class="descuento"
                          type="number" 
                          value=""
                          data-dsct="{{ $producto->id }}"
                          data-price="{{ $producto->precio }}"                          
                          min="1" max="99" 
                          {{ ($producto->precio > 0)?  null :'disabled' }}>
                    </td>
                    <td>    
                        
                        <input type="date" name="fecha_i[{{ $producto->id }}]" value="" min="{{$mindate}}" {{ ($producto->precio > 0)?  null :'disabled'  }} id="fechai_{{ $producto->id }}">
                    </td>
                    <td>
                        
                        <input type="date" name="fecha_f[{{ $producto->id }}]" value="" min="{{ $mindate2 }}" {{ ($producto->precio > 0)?  null :'disabled'  }} id="fechaf_{{ $producto->id }}">
                    </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
                </div>
            </div>
        </div>
      <!-- /card -->
  </form>

</div>

@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
    
    var descuento = $('.descuento')    
    var sendbtn = $('#enviar')    
    
    descuento.change(function (event) {     
        event.preventDefault();        
         if ($(this).val()>0) {             
            sendbtn.removeAttr('disabled')
         }
        let ref= $(this).data('dsct');
        let price=parseFloat($(this).data('price')).toFixed(2);
        let fechai=$('#fechai_'+ref);
        let fechaf=$('#fechaf_'+ref);
        let newprecio=$('#newprecio'+ref)       
        let descuento= price *  $(this).val() / 100
        let thenewprecio=price-descuento
        $('#precio'+ref).val(descuento)

        $(newprecio).html(`
         <strike> S/ ${price} </strike> <br>
         <span class="badge badge-danger"> S/ ${descuento} </span> <br>
          <span class="badge badge-discount">S/ ${thenewprecio} </span>
        `)

        console.log(newprecio)
        

        $(fechai).attr("required", "true");
        $(fechaf).attr("required", "true");
         

        
    });

    

    $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
})
</script>';
@stop
