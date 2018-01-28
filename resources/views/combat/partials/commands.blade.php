<d<div class="panel panel-default">
    <div class="panel-heading">
        Your orders, commander {{ $user->name }}?
    </div>
    <div class="panel-body text-center">
        <div class="col-md-4">
            <a href="{{ route('combat_attack') }}" class="btn btn-attack"><i class="ra ra-crossed-sabres"></i> Attack</a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('combat_escape') }}" class="btn btn-escape"><i class="fa fa-reply-all"></i> Escape</a>
        </div>

        <div class="col-md-4">
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#confirm_delete">
                <i class="fa fa-flag-o"></i> Surrender
            </button>
            @include('modal.delete-ship')
        </div>
    </div>
</div>