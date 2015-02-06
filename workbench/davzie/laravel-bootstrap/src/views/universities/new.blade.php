@extends('laravel-bootstrap::layouts.interface-new')

@section('title')
    Додавання університету
@stop

@section('heading')
    <h1>Додавання університету</h1>
@stop

@section('form-items')

    <div class="form-group">
        {{ Form::label( "name" , 'Назва' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "name" , Input::old( "name" ) , array( 'class'=>'form-control' , 'placeholder'=>'Назва' ) ) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "adress" , 'Адреса' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "adress" , Input::old( "adress" ) , array( 'class'=>'form-control' , 'placeholder'=>'Адреса' ) ) }}
        </div>
    </div>

@stop
