@php $user = Auth::user(); $city = $user->isIn(); $ship = $user->activeShip(); @endphp
{{-- design inspiration http://www.manapool.co.uk/wp-content/uploads/2010/11/Patrician-4-trade.jpg --}}
<table class="table trading-table">
    <colgroup>
        <col class="goods"/>
        <col class="stock"/>
        <col class="sell"/>
        <col class="buy"/>
        <col class="ship-stock"/>
        <col class="trade"/>
    </colgroup>
    <thead>
    <tr>
        <th>
            Good
        </th>
        <th>
            City stock
        </th>
        <th>
            Sell
        </th>
        <th>
            Buy
        </th>
        <th>
            Ship stock
        </th>
        <th>
            Trade
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">@svg('008-cigar', 'icon-trade', ['alt' => 'tobacco'])</th>
        <td>{{ $city->tobacco_stock }} lb.</td>
        <td>{{ $city->tobacco_sell}}</td>
        <td>{{ $city->tobacco_buy }}</td>
        <td>@if ($ship != null){{ $ship->tobacco }} @else N/A @endif</td>
        <td>
            {{ Form::open(['method' => 'POST', 'route' => ['trade'], 'class'=>'form-inline trade-form trade-form-tobacco']) }}
            <div class="input-group">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-primary dropdown-replace dropdown-toggle text-capitalize"
                            data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" name="Buy">buy<i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-menu btn-dropdown">
                        {{ Form::hidden('action', 'buy', array('class' => 'trade-action')) }}
                        <a class="dropdown-item text-capitalize" href="#">sell</a>
                    </div>
                </div>
                <input name="quantity" type="number" class="form-control input-trade" aria-label="Amount of goods" value="{!! old('quantity') !!}">
            </div>
            {{ Form::hidden('type', 'tobacco') }}
            {{ Form::submit('Trade', ['class' => 'btn btn-primary']) }}
            {{ Form::close() }}
        </td>
    </tr>
    </tbody>
</table>