@extends('laravel-bootstrap::layouts.interface-new')

@section('title')
    Додавання ролі
@stop

@section('breadcrumbs')
    <li class=""><a href="{{URL::action('Davzie\LaravelBootstrap\Controllers\RolesController@getIndex')}}">Ролі</a></li>
    <li class="active">Додавання ролі</li>
@stop

@section('heading')
    <h1>Додавання ролі</h1>
@stop

@section('form-items')

    <div class="form-group">
        {{ Form::label( "name" , 'Назва' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "name" , Input::old( "name" ) , array( 'class'=>'form-control' , 'placeholder'=>'Назва' ) ) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "key" , 'Ключ' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "key" , Input::old( "key" ) , array( 'class'=>'form-control' , 'placeholder'=>'Ключ' ) ) }}
        </div>
    </div>

@stop
