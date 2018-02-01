<div class="panel panel-default">
    <div class="panel-heading">
        Shipwright services
    </div>
    <div class="panel-body">
        @if ($active != null)
        {{ Form::open(['method' => 'POST', 'route' => ['buy_cannons'], 'class'=>'form-inline']) }}
        <div class="form-group">
            <label class="sr-only" for="goods">Amount of cannons</label>
            <div class="input-group">
                <div class="input-group-addon">@svg('cannon', 'icon-sm')
                </div>
                <input type="number" name="cannons" class="form-control" id="goods"
                       placeholder="Amount of cannons"
                       value="{!! old('cannons') !!}">
                <span class="input-group-addon">max {{ $active->gunports - $active->cannons }}</span>
            </div>
        </div>
        {{ Form::submit('Buy cannons', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}

        @else
            <p>Please set an active ship to access the shipwright services.</p>
        @endif
    </div>
</div>