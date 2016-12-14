@extends('layouts.user.app')

@section('title')
    @lang('user.home')
@endsection

@section('content')
@include('layouts.user.categories')
    Hello user
@endsection
