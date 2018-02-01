<div class="panel panel-default">
    <div class="panel-heading">
        The <a href="{{ $ship->path() }}">{{ $ship->name }}</a>
        @if ($ship->is_beginner_ship == true)
            - <i class="fa fa-child"></i>
        @endif
        <span class="pull-right">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512"
                 style="enable-background:new 0 0 512 512;" xml:space="preserve" width="20px"
                 height="20px">
                <g>
                    <g>
                        @include('icons.ship')
                    </g>
                </g>
            </svg>
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