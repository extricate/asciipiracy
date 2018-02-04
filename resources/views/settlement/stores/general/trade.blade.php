{{-- design inspiration http://www.manapool.co.uk/wp-content/uploads/2010/11/Patrician-4-trade.jpg --}}
<div class="table-responsive">
    <table class="table trading-table">
        <colgroup>
            <col class="trade-goods"/>
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
                <div class="pull-right"> @svg('crate', 'icon-xs icon-brown-bg') <label
                            class="label label-ship">{{ $ship->free_hold }} / {{ $ship->total_hold }}</label>
                </div>
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
                                aria-haspopup="true" aria-expanded="false" name="Buy">buy<i
                                    class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-menu btn-dropdown">
                            {{ Form::hidden('action', 'buy', array('class' => 'trade-action')) }}
                            <a class="dropdown-item text-capitalize" href="#">sell</a>
                        </div>
                    </div>
                    <input name="quantity" type="number" class="form-control input-trade" aria-label="Amount of goods"
                           value="{!! old('quantity') !!}">
                    {{ Form::submit('Trade', ['class' => 'btn btn-primary input-group-addon btn-trade']) }}
                </div>
                {{ Form::hidden('type', 'tobacco') }}
                {{ Form::close() }}
            </td>
        </tr>
        <tr>
            <th scope="row">@svg('beans', 'icon-trade', ['alt' => 'coffee'])</th>
            <td>{{ $city->coffee_stock }} lb.</td>
            <td>{{ $city->coffee_sell}}</td>
            <td>{{ $city->coffee_buy }}</td>
            <td>@if ($ship != null){{ $ship->coffee }} @else N/A @endif</td>
            <td>
                {{ Form::open(['method' => 'POST', 'route' => ['trade'], 'class'=>'form-inline trade-form trade-form-coffee']) }}
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary dropdown-replace dropdown-toggle text-capitalize"
                                data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" name="Buy">buy<i
                                    class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-menu btn-dropdown">
                            {{ Form::hidden('action', 'buy', array('class' => 'trade-action')) }}
                            <a class="dropdown-item text-capitalize" href="#">sell</a>
                        </div>
                    </div>
                    <input name="quantity" type="number" class="form-control input-trade" aria-label="Amount of goods"
                           value="{!! old('quantity') !!}">
                    {{ Form::submit('Trade', ['class' => 'btn btn-primary input-group-addon btn-trade']) }}
                </div>
                {{ Form::hidden('type', 'coffee') }}
                {{ Form::close() }}
            </td>
        </tr>
        <tr>
            <th scope="row">@svg('009-sugar', 'icon-trade', ['alt' => 'sugar'])</th>
            <td>{{ $city->sugar_stock }} lb.</td>
            <td>{{ $city->sugar_sell}}</td>
            <td>{{ $city->sugar_buy }}</td>
            <td>@if ($ship != null){{ $ship->sugar }} @else N/A @endif</td>
            <td>
                {{ Form::open(['method' => 'POST', 'route' => ['trade'], 'class'=>'form-inline trade-form trade-form-sugar']) }}
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary dropdown-replace dropdown-toggle text-capitalize"
                                data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" name="Buy">buy<i
                                    class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-menu btn-dropdown">
                            {{ Form::hidden('action', 'buy', array('class' => 'trade-action')) }}
                            <a class="dropdown-item text-capitalize" href="#">sell</a>
                        </div>
                    </div>
                    <input name="quantity" type="number" class="form-control input-trade" aria-label="Amount of goods"
                           value="{!! old('quantity') !!}">
                    {{ Form::submit('Trade', ['class' => 'btn btn-primary input-group-addon btn-trade']) }}
                </div>
                {{ Form::hidden('type', 'sugar') }}
                {{ Form::close() }}
            </td>
        </tr>
        <tr>
            <th scope="row">@svg('004-powder', 'icon-trade', ['alt' => 'spices'])</th>
            <td>{{ $city->spices_stock }} lb.</td>
            <td>{{ $city->spices_sell}}</td>
            <td>{{ $city->spices_buy }}</td>
            <td>@if ($ship != null){{ $ship->spices }} @else N/A @endif</td>
            <td>
                {{ Form::open(['method' => 'POST', 'route' => ['trade'], 'class'=>'form-inline trade-form trade-form-spices']) }}
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary dropdown-replace dropdown-toggle text-capitalize"
                                data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" name="Buy">buy<i
                                    class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-menu btn-dropdown">
                            {{ Form::hidden('action', 'buy', array('class' => 'trade-action')) }}
                            <a class="dropdown-item text-capitalize" href="#">sell</a>
                        </div>
                    </div>
                    <input name="quantity" type="number" class="form-control input-trade" aria-label="Amount of goods"
                           value="{!! old('quantity') !!}">
                    {{ Form::submit('Trade', ['class' => 'btn btn-primary input-group-addon btn-trade']) }}
                </div>
                {{ Form::hidden('type', 'spices') }}
                {{ Form::close() }}
            </td>
        </tr>

        <tr>
            <th scope="row">@svg('leather', 'icon-trade', ['alt' => 'furs'])</th>
            <td>{{ $city->furs_stock }} lb.</td>
            <td>{{ $city->furs_sell}}</td>
            <td>{{ $city->furs_buy }}</td>
            <td>@if ($ship != null){{ $ship->furs }} @else N/A @endif</td>
            <td>
                {{ Form::open(['method' => 'POST', 'route' => ['trade'], 'class'=>'form-inline trade-form trade-form-furs']) }}
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary dropdown-replace dropdown-toggle text-capitalize"
                                data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" name="Buy">buy<i
                                    class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-menu btn-dropdown">
                            {{ Form::hidden('action', 'buy', array('class' => 'trade-action')) }}
                            <a class="dropdown-item text-capitalize" href="#">sell</a>
                        </div>
                    </div>
                    <input name="quantity" type="number" class="form-control input-trade" aria-label="Amount of goods"
                           value="{!! old('quantity') !!}">
                    {{ Form::submit('Trade', ['class' => 'btn btn-primary input-group-addon btn-trade']) }}
                </div>
                {{ Form::hidden('type', 'furs') }}
                {{ Form::close() }}
            </td>
        </tr>

        <tr>
            <th scope="row">@svg('005-barrel', 'icon-trade', ['alt' => 'alcohol'])</th>
            <td>{{ $city->alcohol_stock }} lb.</td>
            <td>{{ $city->alcohol_sell}}</td>
            <td>{{ $city->alcohol_buy }}</td>
            <td>@if ($ship != null){{ $ship->alcohol }} @else N/A @endif</td>
            <td>
                {{ Form::open(['method' => 'POST', 'route' => ['trade'], 'class'=>'form-inline trade-form trade-form-alcohol']) }}
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary dropdown-replace dropdown-toggle text-capitalize"
                                data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" name="Buy">buy<i
                                    class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-menu btn-dropdown">
                            {{ Form::hidden('action', 'buy', array('class' => 'trade-action')) }}
                            <a class="dropdown-item text-capitalize" href="#">sell</a>
                        </div>
                    </div>
                    <input name="quantity" type="number" class="form-control input-trade" aria-label="Amount of goods"
                           value="{!! old('quantity') !!}">
                    {{ Form::submit('Trade', ['class' => 'btn btn-primary input-group-addon btn-trade']) }}
                </div>
                {{ Form::hidden('type', 'alcohol') }}
                {{ Form::close() }}
            </td>
        </tr>

        <tr>
            <th scope="row">@svg('006-cloth', 'icon-trade', ['alt' => 'textiles'])</th>
            <td>{{ $city->textiles_stock }} lb.</td>
            <td>{{ $city->textiles_sell}}</td>
            <td>{{ $city->textiles_buy }}</td>
            <td>@if ($ship != null){{ $ship->textiles }} @else N/A @endif</td>
            <td>
                {{ Form::open(['method' => 'POST', 'route' => ['trade'], 'class'=>'form-inline trade-form trade-form-textiles']) }}
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary dropdown-replace dropdown-toggle text-capitalize"
                                data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" name="Buy">buy<i
                                    class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-menu btn-dropdown">
                            {{ Form::hidden('action', 'buy', array('class' => 'trade-action')) }}
                            <a class="dropdown-item text-capitalize" href="#">sell</a>
                        </div>
                    </div>
                    <input name="quantity" type="number" class="form-control input-trade" aria-label="Amount of goods"
                           value="{!! old('quantity') !!}">
                    {{ Form::submit('Trade', ['class' => 'btn btn-primary input-group-addon btn-trade']) }}
                </div>
                {{ Form::hidden('type', 'textiles') }}
                {{ Form::close() }}
            </td>
        </tr>

        <tr>
            <th scope="row">@svg('002-wood', 'icon-trade', ['alt' => 'mahogany'])</th>
            <td>{{ $city->mahogany_stock }} lb.</td>
            <td>{{ $city->mahogany_sell}}</td>
            <td>{{ $city->mahogany_buy }}</td>
            <td>@if ($ship != null){{ $ship->mahogany }} @else N/A @endif</td>
            <td>
                {{ Form::open(['method' => 'POST', 'route' => ['trade'], 'class'=>'form-inline trade-form trade-form-mahogany']) }}
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary dropdown-replace dropdown-toggle text-capitalize"
                                data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" name="Buy">buy<i
                                    class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-menu btn-dropdown">
                            {{ Form::hidden('action', 'buy', array('class' => 'trade-action')) }}
                            <a class="dropdown-item text-capitalize" href="#">sell</a>
                        </div>
                    </div>
                    <input name="quantity" type="number" class="form-control input-trade" aria-label="Amount of goods"
                           value="{!! old('quantity') !!}">
                    {{ Form::submit('Trade', ['class' => 'btn btn-primary input-group-addon btn-trade']) }}
                </div>
                {{ Form::hidden('type', 'mahogany') }}
                {{ Form::close() }}
            </td>
        </tr>

        <tr>
            <th scope="row">@svg('007-gems', 'icon-trade', ['alt' => 'gemstones'])</th>
            <td>{{ $city->gemstones_stock }} lb.</td>
            <td>{{ $city->gemstones_sell}}</td>
            <td>{{ $city->gemstones_buy }}</td>
            <td>@if ($ship != null){{ $ship->gemstones }} @else N/A @endif</td>
            <td>
                {{ Form::open(['method' => 'POST', 'route' => ['trade'], 'class'=>'form-inline trade-form trade-form-gemstones']) }}
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary dropdown-replace dropdown-toggle text-capitalize"
                                data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" name="Buy">buy<i
                                    class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-menu btn-dropdown">
                            {{ Form::hidden('action', 'buy', array('class' => 'trade-action')) }}
                            <a class="dropdown-item text-capitalize" href="#">sell</a>
                        </div>
                    </div>
                    <input name="quantity" type="number" class="form-control input-trade" aria-label="Amount of goods"
                           value="{!! old('quantity') !!}">
                    {{ Form::submit('Trade', ['class' => 'btn btn-primary input-group-addon btn-trade']) }}
                </div>
                {{ Form::hidden('type', 'gemstones') }}
                {{ Form::close() }}
            </td>
        </tr>
        </tbody>
    </table>
</div>