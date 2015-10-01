@extends('laravel-bootstrap::layouts.interface-edit')

@section('title')
    Редагування коментаря
@stop

@section('breadcrumbs')
    <li><a href="{{action($module . '@getIndex')}}">Коментарі</a></li>
    <li class="active">Редагування коментаря</li>
@stop

@section('heading')
    <h1>Редагування коментаря</h1>
@stop

@section('form-items')

    <div class="form-group">
        {{ Form::label( "title" , 'Назва' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "title" , Input::old( "title", $item->title ) , array( 'class'=>'form-control' , 'placeholder'=>'Назва') ) }}
        </div>
    </div>

    {{Form::hidden('new_id', $item->new_id, array())}}

    <div class="form-group">
        {{ Form::label( "text" , 'Коментар' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::textarea( "text" , Input::old( "text", $item->text ) , array( 'class'=>'form-control' , 'placeholder'=>'Коментар' ) ) }}
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