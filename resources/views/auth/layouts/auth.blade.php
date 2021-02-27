@extends('layouts.userapp')

@section('page')

    {{--Region Content--}}
    @yield('content')

@endsection

@section('styles')
    {{ Html::style(('assets/auth/css/auth.css')) }}
@endsection
