<div class="panel panel-default">
    <div class="panel-heading">
        Upgrade ship @if ($active != null) <span class="pull-right label label-default">{{ $active->upgrade_points }} upgrade points</span> @endif
    </div>
    <div class="panel-body">
        @if ($active != null)
            <div class="col-lg-5">
                <p>What kind of upgrades are you interested in?</p>

                {{ Form::open(['method' => 'POST', 'route' => ['ship_upgrade'], 'class'=>'form-inline']) }}
                {{ Form::hidden('gunports') }}
                {{ Form::submit('+ 2 gunports', ['class' => 'btn btn-primary']) }}
                {{ Form::close() }}

                {{ Form::open(['method' => 'POST', 'route' => ['ship_upgrade'], 'class'=>'form-inline']) }}
                {{ Form::hidden('max_health') }}
                {{ Form::submit('+ 20 hitpoints', ['class' => 'btn btn-primary']) }}
                {{ Form::close() }}

                {{ Form::open(['method' => 'POST', 'route' => ['ship_upgrade'], 'class'=>'form-inline']) }}
                {{ Form::hidden('max_sailors') }}
                {{ Form::submit('+ 10 sailors', ['class' => 'btn btn-primary']) }}
                {{ Form::close() }}
            </div>
            <div class="col-lg-7">
                {{ $active->draw($active) }}
            </div>
        @else
            <div class="col-lg-5">
                <p>Please set an active ship to access the shipwright upgrade services.</p>
            </div>
        @endif
    </div>
</div>