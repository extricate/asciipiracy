@extends('modal.modal')

@section('id'){{'confirm_repair_' . $ship->id}}@endsection

@section('title')
    Confirmation needed
@endsection

@section('body')
    <p>Alright, the repairs on this ship are gonna cost about {{ $ship->repairCost($ship) }} gold.</p>
@endsection

@section('submit')
    {{ Form::open(['method' => 'PUT', 'class' => 'form-inline', 'route' => ['ship_repair', $ship->id]]) }}
    {{ Form::submit('Repair ship', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection