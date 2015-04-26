
@section('content')


    @yield('heading')


@extends('laravel-bootstrap::layouts.interface')
    {{ Form::open( array('class'=>'form-horizontal form-top-margin' , 'role'=>'form' ) ) }}

        {{-- The error / success messaging partial --}}
        @include('laravel-bootstrap::partials.messaging')

        @yield('form-items')

        @if (isset($langs))
    		@include('laravel-bootstrap::partials.langs', ['langs' => $langs, 'lang_id' => $lang_id, 'id' => $id])
    	@endif
        @yield('form-additional-block')

        {{ Form::submit('Створити' , array('class'=>'btn btn-large btn-primary ')) }}

    {{ Form::close() }}

@stop
