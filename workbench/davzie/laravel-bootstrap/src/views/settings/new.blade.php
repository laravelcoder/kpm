@extends('laravel-bootstrap::layouts.interface-new')

@section('title')
    Додавання налаштування
@stop

@section('breadcrumbs')
    <li><a href="{{action($module . '@getIndex')}}">Налаштування</a></li>
    <li class="active">Додавання налаштування</li>
@stop

@section('heading')
    <h1>Додавання налаштування</h1>
@stop

@section('form-items')

    <div class="form-group">
        {{ Form::label( "label" , 'Назва' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "label" , Input::old( "label" ) , array( 'class'=>'form-control' , 'placeholder'=>'Назва' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "key" , 'Ключ' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "key" , Input::old( "key" ) , array( 'class'=>'form-control' , 'placeholder'=>'Ключ' ) ) }}
        </div>
    </div>


    <div class="form-group">
        {{ Form::label( "value" , 'Значення' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "value" , Input::old( "value" ) , array( 'class'=>'form-control' , 'placeholder'=>'Значення' ) ) }}
        </div>
    </div>

@stop

@section('form-additional-block')
    <a href="{{action($module . '@getIndex')}}" class="btn btn-danger">Назад</a>
@stop
