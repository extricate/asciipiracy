@extends('modal.modal')

@section('id')lowhealth@endsection

@section('modal_title')
    Are you sure about that?
@endsection

@section('body')
    <p>Your ship is low on health, are you sure you want to do this?</p>
@endsection

@section('submit')
    <a href="{{ route('explore_now') }}">Continue</a>
@endsection