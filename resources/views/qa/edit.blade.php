
@extends('layouts.app')
@section('title', __('dic/qa.title'))

@section('contents')
<body>
    {!! Form::open(['url' => route('qa.confirm', ['qa_id' => $defaults['qa_id'] ?? null])]) !!}
        <div　class="form-group @if($errors->first('content')) has-error @endif">
            {!! Form::label('content', __('dic/qa.content')) !!}
            <div>
                {!! Form::textarea('content', $defaults['content'] ?? null) !!}
            </div>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary">{{ __('dic/common.submit') }}</button>
        </div>
    {!! Form::close() !!}
</body>
@endsection