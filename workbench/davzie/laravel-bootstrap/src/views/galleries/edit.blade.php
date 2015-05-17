@extends('laravel-bootstrap::layouts.interface-edit')

@section('title')
    Редагування галереї
@stop

@section('breadcrumbs')
    <li><a href="{{action($module . '@getIndex')}}">Галереї</a></li>
    <li class="active">Редагування галереї</li>
@stop

@section('heading')
    <h1>Редагування галереї</h1>
@stop

@section('form-items')

    <div class="form-group">
        {{ Form::label( "title" , 'Назва' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "title" , Input::old( "title", $item->title ) , array( 'class'=>'form-control' , 'placeholder'=>'Назва') ) }}
        </div>
    </div>

    {{Form::hidden('lang_id', Input::old('lang_id', $item->lang_id), array())}}

    @include('laravel-bootstrap::partials.upload', ['name' => 'photo_storage_id', 'label' => 'Фото', 'path' => $path['photo_storage_id'], 'value' => $item->photo_storage_id, 'dir' => 'news'])

    <div class="form-group">
        {{ Form::label( "descr" , 'Короткий опис' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::textarea( "descr" , Input::old( "descr", $item->descr ) , array( 'class'=>'form-control' , 'placeholder'=>'Короткий опис', 'rows' => 10 ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "is_active" , 'Активна' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{Form::hidden('is_active', 0)}}
            {{ Form::checkbox( "is_active" , Input::old("is_active", 1), $item->is_active) }}
        </div>
    </div>

    @include('laravel-bootstrap::partials.gallery', ['items' => $item->photos ? $item->photos : [], 'id' => $item->id])

@stop

@section('form-additional-block')
    <a href="{{action($module . '@getIndex')}}" class="btn btn-danger">Назад</a>
@stop
