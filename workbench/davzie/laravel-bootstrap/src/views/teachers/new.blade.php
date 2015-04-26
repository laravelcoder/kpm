@extends('laravel-bootstrap::layouts.interface-new')

@section('title')
    Додавання інформації про викладача
@stop

@section('breadcrumbs')
    <li><a href="{{action($module . '@getIndex')}}">Викладачі</a></li>
    <li class="active">Додавання інформації про викладача</li>
@stop

@section('heading')
    <h1>Додавання інформації про викладача</h1>
@stop

@section('form-items')
    <div class="form-group">
        {{ Form::label( "surname" , 'Прізвище' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "surname" , Input::old( "surname" ) , array( 'class'=>'form-control' , 'placeholder'=>'Прізвище' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "name" , 'Імя' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "name" , Input::old( "name" ) , array( 'class'=>'form-control' , 'placeholder'=>'Імя' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "second_name" , 'По батькові' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "second_name" , Input::old( "second_name" ) , array( 'class'=>'form-control' , 'placeholder'=>'По батькові' ) ) }}
        </div>
    </div>

    {{Form::hidden('lang_id', Input::old('lang_id', $lang_id), array())}}
    {{Form::hidden('id', Input::old('id', $id), array())}}

    @include('laravel-bootstrap::partials.upload', ['name' => 'photo_storage_id', 'label' => 'Фото', 'path' => $path['photo_storage_id'], 'dir' => 'teachers'])

    <div class="form-group">
        {{ Form::label( "birthdate" , 'Дата народження' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "birthdate" , Input::old( "birthdate" ) , array( 'class'=>'form-control datepicker' , 'placeholder'=>'Дата народження' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "about" , 'Інформація' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::textarea( "about" , Input::old( "about" ) , array( 'class'=>'form-control rich' , 'placeholder'=>'Інформація', 'rows' => 30 ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "is_active" , 'Активний' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{Form::hidden('is_active', 0)}}
            {{ Form::checkbox( "is_active" , Input::old("is_active", 1), $default->is_active) }}
        </div>
    </div>
@stop

@section('form-additional-block')
    <a href="{{action($module . '@getIndex')}}" class="btn btn-danger">Назад</a>
@stop
