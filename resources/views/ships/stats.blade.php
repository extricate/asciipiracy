<ul class="list-inline stats-list">
    <li class="label label-default">
        lvl {{ $ship->level }} <br>
    </li>
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
        <i class="fa fa-users"></i> {{ $ship->current_sailors }}/{{ $ship->max_sailors }}
    </li>
    @if ($ship->upgrade_points > 0)
    <li class="label label-default">
        <i class="fa fa-arrow-up"></i> {{ $ship->upgrade_points }}
    </li>
    @endif
    <li>
        <progress class="experience-bar" max="100"
                  value="{{ $ship->levelProgress($ship) }}">
        </progress>
    </li>
</ul>
