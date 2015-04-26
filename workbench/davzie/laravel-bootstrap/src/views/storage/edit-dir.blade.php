@extends('laravel-bootstrap::layouts.interface-edit')

@section('title')
    Редагування папки
@stop

@section('breadcrumbs')
    <li><a href="{{action($module . '@getIndex', array($item->parent_id))}}">Файли</a></li>
    <li class="active">Редагування папки</li>
@stop

@section('heading')
    <h1>Редагування папки</h1>
@stop

@section('form-items')

    <div class="form-group">
        {{ Form::label( "filename" , 'Назва' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "filename" , Input::old( "filename", $item->filename ) , array( 'class'=>'form-control' , 'placeholder'=>'Назва' ) ) }}
        </div>
    </div>

@stop

@section('form-additional-block')
    <a href="{{action($module . '@getIndex', array($item->parent_id))}}" class="btn btn-danger">Назад</a>
@stop
