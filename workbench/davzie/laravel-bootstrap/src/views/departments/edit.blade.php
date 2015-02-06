@extends('laravel-bootstrap::layouts.interface-edit')

@section('title')
    Редагування кафедри
@stop

@section('breadcrumbs')
    <li><a href="{{route('universities')}}">Університети</a></li>
    <li class="active">{{$faculty->university->name}}</li>
    <li class=""><a href="{{route('faculties', $faculty->university->id)}}">Факультети</a></li>
    <li class=""><a href="{{route('departments', $faculty->id)}}">Кафедри</a></li>
    <li class="active">Редагування кафедри</li>
@stop

@section('heading')
    <h1>Редагування кафедри <br /><small>{{$faculty->title}} факультет <br />{{$faculty->university->name}}</small></h1>
@stop

@section('form-items')
    <div class="form-group">
        <div class="col-lg-10">
            {{Form::hidden('faculty_id', Input::old( "faculty_id", $item->faculty_id ),array( 'class'=>'form-control'))}}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "title" , 'Назва' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "title" , Input::old( "title", $item->title ) , array( 'class'=>'form-control' , 'placeholder'=>'Назва' ) ) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "adress" , 'Адреса' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "adress" , Input::old( "adress", $item->adress ) , array( 'class'=>'form-control' , 'placeholder'=>'Адреса' ) ) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "head" , 'Завідувач кафедри' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "head" , Input::old( "head", $item->head ) , array( 'class'=>'form-control' , 'placeholder'=>'Завідувач кафедри' ) ) }}
        </div>
    </div>

@stop

@section('form-additional-block')
    <a href="{{route('departments', $faculty->id)}}" class="btn btn-danger">Назад</a>
@stop
