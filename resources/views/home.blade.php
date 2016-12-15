@extends('layouts.app')

@section('title')
    @lang('categories.home')
@endsection

@section('content')
    <div class="container">
        @include('layouts.categories')
    </div>
@endsection
