@extends('modal.modal')

@section('id'){{'confirm_repair_' . $ship->id}}@endsection

@section('title')
    Confirmation needed
@endsection

@section('body')
    @if ($ship->repairCost($ship) > 0)
        <p>After fully inspecting the ship, the local carpenter tells you that the repairs on this ship are gonna cost about <b>{{ $ship->repairCost($ship) }}</b> gold for the amount of damage this ship has sustained.</p>
    @else
    <p>
        After inspection the local carpenter comes to the conclusion that this ship isn't damaged. He mumbles something about you being an idiot and goes on his way. Perhaps next time don't waste his time?
    </p>
    @endif
@endsection

@section('submit')
    @if ($ship->repairCost($ship) > 0)
    {{ Form::open(['method' => 'PUT', 'class' => 'form-inline', 'route' => ['ship_repair', $ship->id]]) }}
    {{ Form::submit('Repair ship', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
    @else
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    @endif
@endsection