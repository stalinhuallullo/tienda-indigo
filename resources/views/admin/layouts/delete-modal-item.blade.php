<!-- Modal -->
<div class="modal fade" id="confirm_delete_item" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
  <form id="form_delete_item" method="POST" action="">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModal">{{ $title }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ¿Desea eliminar este registro?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default cancel-item-delete" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Eliminar</button>
        </div>
      </div>
    </div>
  </form>
</div>