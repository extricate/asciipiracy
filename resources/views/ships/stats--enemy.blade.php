<ul class="list-inline stats-list">
    <li class="label label-{{ $enemy->health($enemy) }}">
        <i class="fa fa-heart"></i> {{ $enemy->current_health }}/{{ $enemy->maximum_health }}
    </li>

    <li class="label label-attack"><i class="ra ra-crossed-sabres"></i>
        {{ $enemy->attackStatistics($enemy) }}
    </li>

    <li class="label label-escape">
        <i class="ra ra-cog"></i> {{ $enemy->escapeStatistics($enemy) }}
    </li>
    <li class="label label-crew">
        <i class="fa fa-users"></i> {{ $enemy->current_sailors }}/{{ $enemy->max_sailors }}
    </li>
</ul>