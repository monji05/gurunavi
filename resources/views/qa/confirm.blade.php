
@extends('layouts.app')
@section('title', __('dic/qa.title'))

@section('contents')
<body>
    <div>
        {{ Form::open(['url' => route('qa.complete', ['qa_id' => $defaults['qa_id'] ?? null])]) }}
            <div>
                {{ Form::label(__('dic/qa.content'), $input['content']) }}
            </div>
            <div>
            <button class="button submit" type="submit">{{ __('dic/common.submit') }}</button>
            </div>
            <div>
                {{ Form::hidden('content') }}
            </div>
        {{ Form::close()}}
    </div>
</body>
@endsection