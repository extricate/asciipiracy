<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Your orders, commander {{ $user->name }}?
            </div>
            <div class="panel-body text-center">
                <div class="col-md-4">
                    {{ Form::open(['method' => 'POST', 'class' => 'form-inline', 'route' => ['combat_attack', $ship, $enemy->id]]) }}
                    {{ Form::submit('Fight!', ['class' => 'btn btn-danger']) }}
                    {{ Form::close() }}
                </div>

                <div class="col-md-4">
                    {{ Form::open(['method' => 'POST', 'class' => 'form-inline', 'route' => ['combat_escape', $ship->id]]) }}
                    {{ Form::submit('Escape', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>

                <div class="col-md-4">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm_delete">
                        Surrender
                    </button>
                    @include('modal.show')
                </div>
            </div>
        </div>
    </div>
</div>