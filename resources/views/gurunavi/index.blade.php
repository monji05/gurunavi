@extends('layouts.app')
@section('title', __('dic/gurunavi.title'))



@section('contents')
<body>
    <div id="app">
        <router-view></router-view>
    </div>
</body>
@endsection