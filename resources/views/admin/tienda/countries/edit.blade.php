@extends ('admin.layouts.master')

@section ('content')

<div class="container-fluid">

 <form method="POST" action="{{ route('admin.countries.update', $pais->id) }}">
     {{ csrf_field() }}
     {{ method_field('PUT') }}

     <div class="page-head">
       <h2 class="page-title float-left">Editar País</h2>


       <div class="page-bar toolbarBox">
         <ul id="toolbar-nav" class="nav nav-pills float-right">
             <li>
                 <a class="btn btn-default btn-action" href="{{ route('admin.countries') }}">Cancelar</a>
             </li>
             <li>
                 <button class="btn btn-primary btn-action" type="submit">Actualizar</button>
             </li>
         </ul>
       </div>

     </div>

     <div class="page-date">
         <div class="row">
           <div class="col-md-12"></div>
         </div>
     </div>

     @include('admin.layouts.errors')
     <!-- card -->
       <div class="row">

         <div class="col-sm-12">

            <div class="card mb-3">

              <div class="card-header">País</div>

              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                      <div class="form-row">
                        <div class="form-group col-6">
                          <label for="codigo" class="col-form-label">País <span class="requerido">*</span></label>
                          <div>
                            <input class="form-control" value="{{ $pais->nombre }}" name="nombre" type="text" id="codigo">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="desc">Descripción</label>
                        <textarea class="form-control" name="desc" id="desc" rows="5" col="8">{{ $pais->desc }}</textarea>
                      </div>

                  </div>
                </div>
              </div>
              <div class="card-footer small text-muted"></div>
            </div>

         </div>

       </div>
     <!-- /card -->

     </form>
     
     <div id="app"><!-- BEGIN card  country details VUE-->
        <div class="card mb-3">
            <div class="card-body">
              <country-detail :country-id="{{ $pais->id }}"></country-detail>
            </div>

            <div class="card-footer small text-muted"></div>
        </div>
     </div><!-- END card  country details VUE-->

</div> 
@endsection
@section('scripts')
<script src="{{ asset('js/main.js') }}"></script>
@endsection