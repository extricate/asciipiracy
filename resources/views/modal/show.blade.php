<div class="modal fade" tabindex="-1" role="dialog" id="confirm_delete">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Confirmation needed</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to sink this ship?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {{ Form::open(['method' => 'DELETE', 'class' => 'form-inline', 'route' => ['ship_destroy', $ship->id]]) }}
                {{ Form::submit('Surrender', ['class' => 'btn btn-danger']) }}
                {{ Form::close() }}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->