@extends('laravel-bootstrap::layouts.interface-edit')

@section('title')
    Редагування мови
@stop

@section('breadcrumbs')
    <li><a href="{{action($module . '@getIndex')}}">Мови</a></li>
    <li class="active">Редагування мови</li>
@stop

@section('heading')
    <h1>Редагування мови</h1>
@stop

@section('form-items')

    <div class="form-group">
        {{ Form::label( "name" , 'Назва' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "name" , Input::old( "name", $item->name ) , array( 'class'=>'form-control' , 'placeholder'=>'Назва' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "code" , 'Код' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "code" , Input::old( "code", $item->code ) , array( 'class'=>'form-control' , 'placeholder'=>'Код' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "is_active" , 'Активна' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{Form::hidden('is_active', 0)}}
            {{ Form::checkbox( "is_active" , Input::old("is_active", 1), $item->is_active) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "is_default" , 'За замовчуванням' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{Form::hidden('is_default', 0)}}
            {{ Form::checkbox( "is_default" , Input::old("is_default", 1), $item->is_default) }}
        </div>
    </div>

@stop

@section('form-additional-block')
    <a href="{{action($module . '@getIndex')}}" class="btn btn-danger">Назад</a>
@stop
