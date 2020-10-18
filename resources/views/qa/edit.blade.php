
@extends('layouts.app')
@section('title', __('dic/qa.title'))

@section('contents')
<body>
    {{ Form::open(['url' => route('qa.confirm', ['qa_id' => $defaults['qa_id'] ?? null])]) }}
        <div>
            {{ Form::label(__('dic/qa.content')) }}
            <div>
                {{ Form::textarea('content', $defaults['content'] ?? null) }}
            </div>
        </div>
        <div class="cls">
            <button class="submit" type="submit">{{ __('dic/common.submit') }}</button>
        </div>
    {{ Form::close() }}
</body>
@endsection