{{-- Blade including isn't working in the foreach loop --}}
<div class="modal fade" tabindex="-1" role="dialog"
     id="{{'confirm_repair_' . $ship->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                Confirmation needed
            </div>
            <div class="modal-body">
                <p>Alright, the repairs on this ship are gonna cost
                    about {{ $ship->repairCost($ship) }} gold.</p>
            </div>
            <div class="modal-footer">
                {{ Form::open(['method' => 'PUT', 'class' => 'form-inline', 'route' => ['ship_repair', $ship->id]]) }}
                {{ Form::submit('Repair ship', ['class' => 'btn btn-primary']) }}
                {{ Form::close() }}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="panel panel-default">
    <div class="panel-heading">
        The <a href="{{ $ship->path() }}">{{ $ship->name }}</a>
    </div>
    <div class="panel-body">
        <p>
            She's a {{ $ship->length }} footer with {{ $ship->decks }} decks
            and {{ $ship->crew()->count() }} sailors.
        </p>
        <div class="row">
            <div class="col-md-4">
                @if ($ship->id == $user->active_ship)
                    {{ Form::open(['method' => 'PUT', 'route' => ['set_active_ship', 0]]) }}
                    {{ Form::submit('Active ship', ['class' => 'btn btn-sm btn-primary']) }}
                    {{ Form::close() }}
                @else
                    {{ Form::open(['method' => 'PUT', 'route' => ['set_active_ship', $ship->id]]) }}
                    {{ Form::submit('Make active', ['class' => 'btn btn-sm btn-info']) }}
                    {{ Form::close() }}
                @endif
            </div>
            <div class="col-md-8 text-right">
                <a class="btn btn-default btn-sm" data-toggle="modal"
                   data-target="{{'#confirm_repair_' . $ship->id}}">Repair</a>
                <a class="btn btn-default btn-sm">Upgrade</a>
            </div>
        </div>
    </div>
    <div class="panel-footer text-center">
        @include('ships.stats')
    </div>
</div>