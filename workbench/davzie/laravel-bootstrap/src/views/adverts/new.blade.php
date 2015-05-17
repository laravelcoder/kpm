@extends('laravel-bootstrap::layouts.interface-new')

@section('title')
    Додавання нового оголошення
@stop

@section('breadcrumbs')
    <li><a href="{{action($module . '@getIndex')}}">Оголошення</a></li>
    <li class="active">Додавання нового оголошення</li>
@stop

@section('heading')
    <h1>Додавання нового оголошення</h1>
@stop

@section('form-items')

    <div class="form-group">
        {{ Form::label( "title" , 'Назва' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "title" , Input::old( "title" ) , array( 'class'=>'form-control' , 'placeholder'=>'Назва', 'data-slug' => $default->slug ? '':'[name=slug]' ) ) }}
        </div>
    </div>

    {{Form::hidden('lang_id', Input::old('lang_id', $lang_id), array())}}
    {{Form::hidden('id', Input::old('id', $id), array())}}

    @include('laravel-bootstrap::partials.upload', ['name' => 'photo_storage_id', 'label' => 'Фото', 'path' => $path['photo_storage_id'], 'dir' => 'adverts', 'value' => $default->photo_storage_id ? $default->photo_storage_id : ''])

    <div class="form-group">
        {{ Form::label( "descr" , 'Короткий опис' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::textarea( "descr" , Input::old( "descr" ) , array( 'class'=>'form-control' , 'placeholder'=>'Короткий опис', 'rows' => 10 ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "body" , 'Контент' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::textarea( "body" , Input::old( "body" ) , array( 'class'=>'form-control rich' , 'placeholder'=>'Контент', 'rows' => 30 ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "time_start" , 'Дата початку' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "time_start" , Input::old( "time_start" ) , array( 'class'=>'form-control datetimepicker' , 'placeholder'=>'Дата початку' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "time_end" , 'Дата завершення' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "time_end" , Input::old( "time_end" ) , array( 'class'=>'form-control datetimepicker' , 'placeholder'=>'Дата завершення' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "meta_keywords" , 'Ключові слова' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "meta_keywords" , Input::old( "meta_keywords" ) , array( 'class'=>'form-control' , 'placeholder'=>'Ключові слова' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "meta_descr" , 'Мета опис' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "meta_descr" , Input::old( "meta_descr" ) , array( 'class'=>'form-control' , 'placeholder'=>'Мета опис' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "is_active" , 'Активна' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{Form::hidden('is_active', 0)}}
            {{ Form::checkbox( "is_active" , Input::old("is_active", 1), $default->is_active) }}
        </div>
    </div>
@stop

@section('form-additional-block')
    <a href="{{action($module . '@getIndex')}}" class="btn btn-danger">Назад</a>
@stop
