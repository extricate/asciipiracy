<div class="col-md-6">
    <span class="label label-strength">Strength: {{ $user->strength }}</span>
    <span class="label label-dexterity">Dexterity: {{ $user->dexterity }}</span>
    <span class="label label-intelligence">Intelligence: {{ $user->intelligence }}</span>
    <span class="label label-stamina">Stamina: {{ $user->stamina }}</span>
    <span class="label label-charisma">Charisma: {{ $user->charisma }}</span>

    @if ($user->unallocated_stats > 0)
        <span class="label label-unallocated">Unallocated: {{ $user->unallocated_stats }}</span>
    @endif
</div>

<div class="col-md-6">
    {{ Form::open(['class' => 'form-inline form-stats','method' => 'PUT', 'route' => ['allocate_stats', $stat = 'strength']]) }}
    {{ Form::submit('^', ['class' => 'fa stat-up']) }}
    {{ Form::close() }}

    {{ Form::open(['class' => 'form-inline form-stats','method' => 'PUT', 'route' => ['allocate_stats', $stat = 'dexterity']]) }}
    {{ Form::submit('+') }}
    {{ Form::close() }}

    {{ Form::open(['class' => 'form-inline form-stats','method' => 'PUT', 'route' => ['allocate_stats', $stat = 'intelligence']]) }}
    {{ Form::submit('+') }}
    {{ Form::close() }}
    {{ Form::open(['class' => 'form-inline form-stats','method' => 'PUT', 'route' => ['allocate_stats', $stat = 'stamina']]) }}
    {{ Form::submit('+') }}
    {{ Form::close() }}
    {{ Form::open(['class' => 'form-inline form-stats', 'method' => 'PUT', 'route' => ['allocate_stats', $stat = 'charisma']]) }}
    {{ Form::submit('+') }}
    {{ Form::close() }}
</div>