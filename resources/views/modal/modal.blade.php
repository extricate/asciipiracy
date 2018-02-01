<div class="modal fade" tabindex="-1" role="dialog" id="@yield('id')">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                @yield('modal_title')
            </div>
            <div class="modal-body">
                @yield('body')
            </div>
            <div class="modal-footer">
                @yield('submit')
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->