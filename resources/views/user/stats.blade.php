<div class="row">
    <div class="col-md-4">

    </div>
    <div class="col-md-8 text-right">
        <div class="btn-group btn-group-stats" role="group" aria-label="...">
            <div class="btn btn-strength">Strength: {{ $user->strength }}</div>
            @if ($user->unallocated_stats > 0)
                <button type="button" class="btn btn-default btn-up">
                    {{ Form::open(['class' => 'form-inline form-stats', 'method' => 'PUT', 'route' => ['allocate_stats', $stat = 'strength']]) }}
                    {{ Form::submit('up', ['class' => 'btn-stats-up']) }}
                    {{ Form::close() }}
                </button>
            @endif
        </div>
        <div class="btn-group btn-group-stats" role="group" aria-label="...">
            <div class="btn btn-dexterity">Dexterity: {{ $user->dexterity }}</div>
            @if ($user->unallocated_stats > 0)
                <button type="button" class="btn btn-default btn-up">
                    {{ Form::open(['class' => 'form-inline form-stats', 'method' => 'PUT', 'route' => ['allocate_stats', $stat = 'dexterity']]) }}
                    {{ Form::submit('up', ['class' => 'btn-stats-up']) }}
                    {{ Form::close() }}
                </button>
            @endif
        </div>
        <div class="btn-group btn-group-stats" role="group" aria-label="...">
            <div class="btn btn-intelligence">Intelligence: {{ $user->intelligence }}</div>
            @if ($user->unallocated_stats > 0)
                <button type="button" class="btn btn-default btn-up">
                    {{ Form::open(['class' => 'form-inline form-stats', 'method' => 'PUT', 'route' => ['allocate_stats', $stat = 'intelligence']]) }}
                    {{ Form::submit('up', ['class' => 'btn-stats-up']) }}
                    {{ Form::close() }}
                </button>
            @endif
        </div>
        <div class="btn-group btn-group-stats" role="group" aria-label="...">
            <div class="btn btn-stamina">Stamina: {{ $user->stamina }}</div>
            @if ($user->unallocated_stats > 0)
                <button type="button" class="btn btn-default btn-up">
                    {{ Form::open(['class' => 'form-inline form-stats', 'method' => 'PUT', 'route' => ['allocate_stats', $stat = 'stamina']]) }}
                    {{ Form::submit('up', ['class' => 'btn-stats-up']) }}
                    {{ Form::close() }}
                </button>
            @endif
        </div>
        <div class="btn-group btn-group-stats" role="group" aria-label="...">
            <div class="btn btn-charisma">Charisma: {{ $user->charisma }}</div>
            @if ($user->unallocated_stats > 0)
                <button type="button" class="btn btn-default btn-up">
                    {{ Form::open(['class' => 'form-inline form-stats', 'method' => 'PUT', 'route' => ['allocate_stats', $stat = 'charisma']]) }}
                    {{ Form::submit('up', ['class' => 'btn-stats-up']) }}
                    {{ Form::close() }}
                </button>
            @endif
        </div>
        @if ($user->unallocated_stats > 0)
            <div class="btn-group btn-group-stats" role="group">
                <div class="btn btn-unallocated">Unallocated: {{ $user->unallocated_stats }}</div>
            </div>
        @endif
    </div>
</div>