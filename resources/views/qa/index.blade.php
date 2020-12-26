
@extends('layouts.app')
@section('title', __('dic/qa.title'))

@section('contents')
{!! Form::open(['route' => 'qa.create', 'method' => 'GET']) !!}
<div class="body">
    <div>
        <button class="submit" type="submit">{{ __('dic/common.create') }}</button>
    </div>
    <div id="table">
        <table-component></table-component>
    </div>
</div>

{!! Form::close() !!}
@endsection