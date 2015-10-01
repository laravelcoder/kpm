@extends('laravel-bootstrap::layouts.interface-new')

@section('title')
    Створення папки
@stop

@section('breadcrumbs')
    <li><a href="{{action($module . '@getIndex', array($parent_id))}}">Файли</a></li>
    <li class="active">Створення папки</li>
@stop

@section('heading')
    <h1>Створення папки</h1>
@stop

@section('form-items')

    <div class="form-group">
        {{ Form::label( "filename" , 'Назва' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "filename" , Input::old( "filename" ) , array( 'class'=>'form-control' , 'placeholder'=>'Назва' ) ) }}
        </div>
    </div>

    <input type="hidden" name="parent_id" value="{{$parent_id}}">

@stop

@section('form-additional-block')
    <a href="{{action($module . '@getIndex', array($parent_id))}}" class="btn btn-danger">Назад</a>
@stop
