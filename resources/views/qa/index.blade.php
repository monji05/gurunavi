
@extends('layouts.app')
@section('title', __('dic/qa.title'))

@section('contents')
{!! Form::open(['route' => 'qa.create', 'method' => 'GET']) !!}
<div class="body">
    <table class="row" align="center">
        <thead>
            <tr>
                <th>{{ __('dic/qa.id') }}</th>
                <th>{{ __('dic/qa.content') }}</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($list))
            @foreach($list as $row)
            <tr>
                <td>{{ $row->qa_id }}</td>
                <td class="text">{{ $row->content }}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <div>
        <button class="submit" type="submit">{{ __('dic/common.create') }}</button>
    </div>
</div>
{!! Form::close() !!}
@endsection