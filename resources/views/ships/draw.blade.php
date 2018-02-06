<div class="row">
    <div class="ship-svg">
        @svg('ship/hull', 'ship-svg ship-hull')
        @svg('ship/bow', 'ship-svg ship-bow')
        @if ($ship->type == 'square')
            @if ($ship->class == 'Barque')
                @svg('ship/fore_mast', 'ship-svg ship-fore-mast')
                @svg('ship/main_mast', 'ship-svg ship-main-mast-barque')
                @svg('ship/aft_gaff', 'ship-svg ship-gaff-aft-barque')
            @elseif ($ship->class == 'Barquentine')
                @svg('ship/fore_mast', 'ship-svg ship-fore-mast-barquentine')
                @svg('ship/aft_gaff', 'ship-svg ship-gaff-aft-barquentine-1')
                @svg('ship/aft_gaff', 'ship-svg ship-gaff-aft-barquentine-2')
            @else
                @if ($ship->masts >= 3)
                    @svg('ship/fore_mast', 'ship-svg ship-fore-mast')
                @endif
                @if ($ship->masts >= 2)
                    @svg('ship/grate', 'ship-svg ship-grate-1')
                @endif
                @svg('ship/main_mast', 'ship-svg ship-main-mast')
                @if ($ship->masts >= 4)
                    @svg('ship/main_mast', 'ship-svg ship-main-mast-2')
                    @svg('ship/rowboat', 'ship-svg ship-rowboat-2')
                @endif

                @if ($ship->masts >= 2)
                    @svg('ship/aft_mast', 'ship-svg ship-aft-mast')
                    @svg('ship/grate', 'ship-svg ship-grate-2')
                @endif

                @if ($ship->length >= 120 OR $ship->masts >= 3)
                    @svg('ship/rowboat', 'ship-svg ship-rowboat-1')
                    @svg('ship/officerdeck', 'ship-svg ship-officer-deck')
                @endif
            @endif
        @elseif ($ship->type == 'gaff')
            @if ($ship->masts >= 2)
                @svg('ship/grate', 'ship-svg ship-grate-1')
                @svg('ship/fore_gaff', 'ship-svg ship-fore-gaff')
                @svg('ship/aft_gaff', 'ship-svg ship-aft-gaff-1')
            @endif
            @if ($ship->masts == 1)
                @svg('ship/main_gaff', 'ship-svg ship-main-gaff')
            @endif
            @if ($ship->length >= 120 OR $ship->masts >= 3)
                @svg('ship/rowboat', 'ship-svg ship-rowboat-1')
                @svg('ship/officerdeck', 'ship-svg ship-officer-deck')
            @endif
        @endif
    </div>
</div>



