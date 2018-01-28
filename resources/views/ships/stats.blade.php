<ul class="list-inline stats-list">
    <li class="label label-{{ $ship->health($ship) }}">
        <i class="fa fa-heart"></i> {{ $ship->current_health }}/{{ $ship->maximum_health }}
    </li>

    <li class="label label-attack"><i class="ra ra-crossed-sabres"></i>
        {{ $ship->attackStatistics($ship) }}
    </li>

    <li class="label label-escape">
        <i class="ra ra-cog"></i> {{ $ship->escapeStatistics($ship) }}
    </li>
    <li class="label label-crew">
        <i class="fa fa-users"></i> {{ $ship->crew->count() }}/{{ $ship->max_sailors }}
    </li>
</ul>
