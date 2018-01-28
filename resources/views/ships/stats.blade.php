<p class="label label-{{ $ship->health($ship) }}">
    <i class="fa fa-heart"></i> {{ $ship->current_health }}/{{ $ship->maximum_health }}
</p>
<br>
<p class="label label-info"><i class="ra ra-crossed-sabres"></i>
    {{ $ship->attackStatistics($ship) }}
</p>
<br>
<p class="label label-primary">
    <i class="ra ra-cog"></i> {{ $ship->escapeStatistics($ship) }}
</p>
<br>
<p class="label label-default">
    <i class="fa fa-users"></i> {{ $ship->crew->count() }}/{{ $ship->max_sailors }}
</p>