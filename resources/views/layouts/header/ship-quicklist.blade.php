<div class="panel panel-default">
    <div class="panel-heading">
        <a href="{{ $ship->path() }}">{{ $ship->name }}</a>
        <span class="pull-right">
            @svg('ship', 'icon-sm')
        </span>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
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
        </div>
    </div>
    <div class="panel-footer text-center">
        @include('ships.stats')
    </div>
</div>