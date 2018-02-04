{{-- Blade including isn't working in the foreach loop --}}
<div class="modal fade" tabindex="-1" role="dialog"
     id="{{'confirm_repair_' . $ship->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                Repair the ship
            </div>
            <div class="modal-body">
                @if ($ship->repairCost($ship) > 0)
                    <p>After fully inspecting the ship, the local carpenter tells you that the repairs on this ship are
                        gonna cost about <span class="label label-warning">{{ $ship->repairCost($ship) }} gold</span> for
                        the amount of damage this ship has sustained.</p>
                @else
                    <p>
                        After inspection the local carpenter comes to the conclusion that this ship isn't damaged. He
                        mumbles something about you being an idiot and goes on his way. Perhaps next time don't waste
                        his time?
                    </p>
                @endif
            </div>
            <div class="modal-footer">
                @if ($ship->repairCost($ship) > 0)
                    {{ Form::open(['method' => 'PUT', 'class' => 'form-inline', 'route' => ['ship_repair', $ship->id]]) }}
                    {{ Form::submit('Repair ship', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                @else
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                @endif
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="panel panel-default">
    <div class="panel-heading">
        <a href="{{ $ship->path() }}">{{ $ship->name }}</a>
        @if ($ship->is_beginner_ship == true)
             <i class="fa fa-star"></i>
        @endif
        <span class="pull-right">
            @svg('ship', 'icon-sm')
        </span>
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