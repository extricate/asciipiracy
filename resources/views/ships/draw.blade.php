@php $ship = Auth::user()->activeShip(); @endphp
<div class="row">
    <div class="ship-svg">
        @svg('ship/hull', 'ship-svg ship-hull')
        @if ($ship->masts >= 3)
            @svg('ship/foresail', 'ship-svg ship-fore-mast')
        @endif

        @if ($ship->masts >= 2)
            @svg('ship/grate', 'ship-svg ship-grate-1')
        @endif

        @svg('ship/bow', 'ship-svg ship-bow')

        @svg('ship/main_mast', 'ship-svg ship-main-mast')

        @if ($ship->masts >= 4)
            @svg('ship/main_mast', 'ship-svg ship-main-mast-2')
            @svg('ship/grate', 'ship-svg ship-grate-2')
        @endif

        @if ($ship->masts >= 2)
            @svg('ship/aft_mast', 'ship-svg ship-aft-mast')
        @endif

        @if ($ship->length >= 120 OR $ship->masts >= 3)
            @svg('ship/officerdeck', 'ship-svg ship-officer-deck')
        @endif
    </div>
</div>



