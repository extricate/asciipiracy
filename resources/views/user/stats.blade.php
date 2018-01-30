<span class="label label-strength">Strength: {{ $user->strength }}</span>
@if ($user->unallocated_stats > 0)
    {{ Form::open(['class' => 'form-inline form-stats', 'method' => 'PUT', 'route' => ['allocate_stats', $stat = 'strength']]) }}
    {{ Form::submit('Up', ['class' => 'label label-stats-up']) }}
    {{ Form::close() }}
@endif

<span class="label label-dexterity">Dexterity: {{ $user->dexterity }}</span>
@if ($user->unallocated_stats > 0)
    {{ Form::open(['class' => 'form-inline form-stats', 'method' => 'PUT', 'route' => ['allocate_stats', $stat = 'dexterity']]) }}
    {{ Form::submit('Up', ['class' => 'label label-stats-up']) }}
    {{ Form::close() }}
@endif

<span class="label label-intelligence">Intelligence: {{ $user->intelligence }}</span>
@if ($user->unallocated_stats > 0)
    {{ Form::open(['class' => 'form-inline form-stats', 'method' => 'PUT', 'route' => ['allocate_stats', $stat = 'intelligence']]) }}
    {{ Form::submit('Up', ['class' => 'label label-stats-up']) }}
    {{ Form::close() }}
@endif

<span class="label label-stamina">Stamina: {{ $user->stamina }}</span>
@if ($user->unallocated_stats > 0)
    {{ Form::open(['class' => 'form-inline form-stats', 'method' => 'PUT', 'route' => ['allocate_stats', $stat = 'stamina']]) }}
    {{ Form::submit('Up', ['class' => 'label label-stats-up']) }}
    {{ Form::close() }}
@endif

<span class="label label-charisma">Charisma: {{ $user->charisma }}</span>
@if ($user->unallocated_stats > 0)
{{ Form::open(['class' => 'form-inline form-stats', 'method' => 'PUT', 'route' => ['allocate_stats', $stat = 'charisma']]) }}
{{ Form::submit('Up', ['class' => 'label label-stats-up']) }}
{{ Form::close() }}
@endif

@if ($user->unallocated_stats > 0)
    <span class="label label-unallocated">Unallocated: {{ $user->unallocated_stats }}</span>
@endif