@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Права для ролі {{$item->name}}
@stop

@section('breadcrumbs')
    <li class="active">Права для ролі {{$item->name}}</li>
@stop

@section('content')

    <h1>Права для ролі <small>{{$item->name}}</small></h1>

    {{-- The error / success messaging partial --}}
    @include('laravel-bootstrap::partials.messaging')

    {{ Form::open( array( 'class'=>'form-horizontal form-top-margin' , 'role'=>'form' ) ) }}
        @foreach ($defPems as $key => $item)
            <h4>{{$item['alias']}}</h4>
            <p style="border-bottom: 1px solid #eee; padding-bottom: 5px;">
                @foreach ($item['rules'] as $rk => $rule)
                <span ><a href="#" @if ($rule['enabled'])class="btn btn-success btn-xs js-toogle-permission"@else class="btn btn-default btn-xs js-toogle-permission" @endif>{{$rule['alias']}}<input type="hidden" name="{{$key}}[{{$rk}}]" value="{{$rule['enabled']}}"></a></span>&nbsp;
                @endforeach
            </p>
        @endforeach
        {{ Form::submit('Зберегти' , array('class'=>'btn btn-large btn-primary ')) }}

    {{ Form::close() }}

@stop
