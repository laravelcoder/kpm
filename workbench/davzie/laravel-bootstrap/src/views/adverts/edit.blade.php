@extends('laravel-bootstrap::layouts.interface-edit')

@section('title')
    Редагування оголошення
@stop

@section('breadcrumbs')
    <li><a href="{{action($module . '@getIndex')}}">Оголошення</a></li>
    <li class="active">Редагування оголошення</li>
@stop

@section('heading')
    <h1>Редагування оголошення</h1>
@stop

@section('form-items')

    <div class="form-group">
        {{ Form::label( "title" , 'Назва' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "title" , Input::old( "title", $item->title ) , array( 'class'=>'form-control' , 'placeholder'=>'Назва' ) ) }}
        </div>
    </div>

    {{Form::hidden('lang_id', Input::old('lang_id', $item->lang_id), array())}}

    @include('laravel-bootstrap::partials.upload', ['name' => 'photo_storage_id', 'label' => 'Фото', 'path' => $path['photo_storage_id'], 'value' => $item->photo_storage_id, 'dir' => 'adverts'])

    <div class="form-group">
        {{ Form::label( "descr" , 'Короткий опис' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::textarea( "descr" , Input::old( "descr", $item->descr ) , array( 'class'=>'form-control' , 'placeholder'=>'Короткий опис', 'rows' => 10 ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "body" , 'Контент' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::textarea( "body" , Input::old( "body", $item->body ) , array( 'class'=>'form-control rich' , 'placeholder'=>'Контент', 'rows' => 30 ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "time_start" , 'Дата початку' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "time_start" , Input::old( "time_start", $item->time_start  ) , array( 'class'=>'form-control datetimepicker' , 'placeholder'=>'Дата початку' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "time_end" , 'Дата завершення' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "time_end" , Input::old( "time_end", $item->time_end  ) , array( 'class'=>'form-control datetimepicker' , 'placeholder'=>'Дата завершення' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "meta_keywords" , 'Ключові слова' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "meta_keywords" , Input::old( "meta_keywords", $item->meta_keywords ) , array( 'class'=>'form-control' , 'placeholder'=>'Ключові слова' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "meta_descr" , 'Мета опис' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "meta_descr" , Input::old( "meta_descr", $item->meta_descr ) , array( 'class'=>'form-control' , 'placeholder'=>'Мета опис' ) ) }}
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