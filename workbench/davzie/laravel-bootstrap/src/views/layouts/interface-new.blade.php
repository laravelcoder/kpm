@extends('laravel-bootstrap::layouts.interface')

@section('content')


    @yield('heading')

    {{ Form::open( array( 'url'=>$new_url , 'class'=>'form-horizontal form-top-margin' , 'role'=>'form' ) ) }}

        {{-- The error / success messaging partial --}}
        @include('laravel-bootstrap::partials.messaging')

        @yield('form-items')
        @yield('form-additional-block')

        {{ Form::submit('Створити' , array('class'=>'btn btn-large btn-primary ')) }}

    {{ Form::close() }}

@stop
