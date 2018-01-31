@php $user = Auth::user(); $city = $user->isIn(); $ship = $user->activeShip(); @endphp
{{-- design inspiration http://www.manapool.co.uk/wp-content/uploads/2010/11/Patrician-4-trade.jpg --}}
<table class="table trading-table">
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
            Price
        </th>
        <th>
            Buy
        </th>
        <th>
            Ship stock
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">Tobacco</th>
        <td>{{ $city->tobacco_stock }}</td>
        <td>{{ $city->tobacco_sell}}</td>
        <td><div class="input-group">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Buy <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-menu btn-dropdown">
                        <a class="dropdown-item" href="#">Sell</a>
                    </div>
                </div>
                <input type="number" class="form-control input-trade" aria-label="Text input with dropdown button">
            </div></td>
        <td>{{ $city->tobacco_buy }}</td>
        <td>@if ($ship != null){{ $ship->tobacco }} @else N/A @endif</td>
    </tr>
    </tbody>
</table>