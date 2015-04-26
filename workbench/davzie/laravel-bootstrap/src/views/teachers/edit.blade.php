@extends('laravel-bootstrap::layouts.interface-edit')

@section('title')
    Редагування інформації про викладача
@stop

@section('breadcrumbs')
    <li><a href="{{action($module . '@getIndex')}}">Викладачі</a></li>
    <li class="active">Редагування інформації про викладача</li>
@stop

@section('heading')
    <h1>Редагування інформації про викладача</h1>
@stop

@section('form-items')

    <div class="form-group">
        {{ Form::label( "surname" , 'Прізвище' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "surname" , Input::old( "surname", $item->surname ) , array( 'class'=>'form-control' , 'placeholder'=>'Прізвище' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "name" , 'Імя' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "name" , Input::old( "name", $item->name ) , array( 'class'=>'form-control' , 'placeholder'=>'Імя' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "second_name" , 'По батькові' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "second_name" , Input::old( "second_name", $item->second_name ) , array( 'class'=>'form-control' , 'placeholder'=>'По батькові' ) ) }}
        </div>
    </div>

    {{Form::hidden('lang_id', Input::old('lang_id', $item->lang_id), array())}}

    @include('laravel-bootstrap::partials.upload', ['name' => 'photo_storage_id', 'label' => 'Фото', 'path' => $path['photo_storage_id'], 'value' => $item->photo_storage_id, 'dir' => 'adverts'])

    <div class="form-group">
        {{ Form::label( "birthdate" , 'Дата народження' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "birthdate" , Input::old( "birthdate", $item->birthdate ) , array( 'class'=>'form-control datepicker' , 'placeholder'=>'Дата народження' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "about" , 'Інформація' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::textarea( "about" , Input::old( "about", $item->about ) , array( 'class'=>'form-control rich' , 'placeholder'=>'Інформація', 'rows' => 30 ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "is_active" , 'Активна' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{Form::hidden('is_active', 0)}}
            {{ Form::checkbox( "is_active" , Input::old("is_active", 1), $item->is_active) }}
        </div>
    </div>

@stop

@section('form-additional-block')
    <a href="{{action($module . '@getIndex')}}" class="btn btn-danger">Назад</a>
@stop