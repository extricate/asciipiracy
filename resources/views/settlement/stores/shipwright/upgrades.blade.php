<div class="panel panel-default">
    <div class="panel-heading">
        Upgrade ship @if ($active != null) <span class="pull-right label label-default">{{ $active->upgrade_points }}
            upgrade points</span> @endif
    </div>
    <div class="panel-body">
        @if ($active != null)
            <div class="col-lg-6">
                <p>What kind of upgrades are you interested in?</p>
                <div class="btn-group btn-group-stats" role="group" aria-label="more hold space">
                    <div class="btn btn-primary btn-upgrade">+ 2000 hold</div>
                    <button type="button" class="btn btn-default btn-up">
                        {{ Form::open(['method' => 'POST', 'route' => ['ship_upgrade'], 'class'=>'form-inline']) }}
                        {{ Form::hidden('hold') }}
                        {{ Form::submit('add', ['class' => 'btn-stats-up']) }}
                        {{ Form::close() }}
                    </button>
                </div>

                <div class="btn-group btn-group-stats" role="group" aria-label="more gunports">
                    <div class="btn btn-primary btn-upgrade">+ 2 gunports</div>
                        <button type="button" class="btn btn-default btn-up">
                            {{ Form::open(['method' => 'POST', 'route' => ['ship_upgrade'], 'class'=>'form-inline']) }}
                            {{ Form::hidden('gunports') }}
                            {{ Form::submit('add', ['class' => 'btn-stats-up']) }}
                            {{ Form::close() }}
                        </button>
                </div>

                <div class="btn-group btn-group-stats" role="group" aria-label="more max health">
                    <div class="btn btn-primary btn-upgrade">+ 20 max health</div>
                        <button type="button" class="btn btn-default btn-up">
                            {{ Form::open(['method' => 'POST', 'route' => ['ship_upgrade'], 'class'=>'form-inline']) }}
                            {{ Form::hidden('max_health') }}
                            {{ Form::submit('add', ['class' => 'btn-stats-up']) }}
                            {{ Form::close() }}
                        </button>
                </div>

                <div class="btn-group btn-group-stats" role="group" aria-label="more max sailors">
                    <div class="btn btn-primary btn-upgrade">+ 10 max sailors</div>
                    <button type="button" class="btn btn-default btn-up">
                        {{ Form::open(['method' => 'POST', 'route' => ['ship_upgrade'], 'class'=>'form-inline']) }}
                        {{ Form::hidden('max_sailors') }}
                        {{ Form::submit('add', ['class' => 'btn-stats-up']) }}
                        {{ Form::close() }}
                    </button>
                </div>

                <div class="btn-group btn-group-stats" role="group" aria-label="more maneuverability">
                    <div class="btn btn-primary btn-upgrade">+ 10 maneuverability</div>
                    <button type="button" class="btn btn-default btn-up">
                        {{ Form::open(['method' => 'POST', 'route' => ['ship_upgrade'], 'class'=>'form-inline']) }}
                        {{ Form::hidden('maneuverability') }}
                        {{ Form::submit('add', ['class' => 'btn-stats-up']) }}
                        {{ Form::close() }}
                    </button>
                </div>

                <div class="btn-group btn-group-stats" role="group" aria-label="extended length">
                    <div class="btn btn-primary btn-upgrade">+ 50 feet length</div>
                    <button type="button" class="btn btn-default btn-up">
                        {{ Form::open(['method' => 'POST', 'route' => ['ship_upgrade'], 'class'=>'form-inline']) }}
                        {{ Form::hidden('length') }}
                        {{ Form::submit('add', ['class' => 'btn-stats-up']) }}
                        {{ Form::close() }}
                    </button>
                </div>
            </div>
            <div class="col-lg-6">
                {{ $active->draw($active) }}
            </div>
        @else
            <div class="col-lg-5">
                <p>Please set an active ship to access the shipwright upgrade services.</p>
            </div>
        @endif
    </div>
</div>