@extends('modal.modal')

@section('id'){{"confirm_delete"}}@endsection

@section('title')
    Confirmation needed
@endsection

@section('body')
    <p>Captain, are you sure you want to sink this ship?</p>
@endsection

@section('submit')
    {{ Form::open(['method' => 'DELETE', 'class' => 'form-inline', 'route' => ['ship_destroy', $ship->id]]) }}
    {{ Form::submit('Delete ship', ['class' => 'btn btn-danger']) }}
    {{ Form::close() }}
@endsection