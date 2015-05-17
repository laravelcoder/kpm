@extends('laravel-bootstrap::layouts.interface-new')

@section('title')
    Додавання галереї
@stop

@section('breadcrumbs')
    <li><a href="{{action($module . '@getIndex')}}">Галереї</a></li>
    <li class="active">Додавання галереї</li>
@stop

@section('heading')
    <h1>Додавання галереї</h1>
@stop

@section('form-items')

    <div class="form-group">
        {{ Form::label( "title" , 'Назва' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "title" , Input::old( "title" ) , array( 'class'=>'form-control' , 'placeholder'=>'Назва' ) ) }}
        </div>
    </div>

    {{Form::hidden('lang_id', Input::old('lang_id', $lang_id), array())}}
    {{Form::hidden('id', Input::old('id', $id), array())}}

    @include('laravel-bootstrap::partials.upload', ['name' => 'photo_storage_id', 'label' => 'Фото', 'path' => $path['photo_storage_id'], 'dir' => 'galleries', 'value' => $default->photo_storage_id ? $default->photo_storage_id : ''])

    <div class="form-group">
        {{ Form::label( "descr" , 'Короткий опис' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::textarea( "descr" , Input::old( "descr" ) , array( 'class'=>'form-control' , 'placeholder'=>'Короткий опис', 'rows' => 10 ) ) }}
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
    {{ Form::submit('Створити та продовжити' , array('class'=>'btn btn-large btn-primary ', 'name' => '_stay', 'value' => 1)) }}
@stop
