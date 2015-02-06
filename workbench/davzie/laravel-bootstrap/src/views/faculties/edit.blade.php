@extends('laravel-bootstrap::layouts.interface-edit')

@section('title')
    Редагування факультету
@stop

@section('breadcrumbs')
    <li><a href="{{route('universities')}}">Університети</a></li>
    <li class="active">{{$university->name}}</li>
    <li class=""><a href="{{route('faculties', $university->id)}}">Факультети</a></li>
    <li class="active">Редагування факультету</li>
@stop

@section('heading')
    <h1>Редагування факультету <small>{{$university->name}}</small></h1>
@stop

@section('form-items')
    <div class="form-group">
        <div class="col-lg-10">
            {{Form::hidden('university_id', Input::old( "university_id", $item->university_id ),array( 'class'=>'form-control'))}}
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
        {{ Form::label( "dean" , 'Декан' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "dean" , Input::old( "dean", $item->dean ) , array( 'class'=>'form-control' , 'placeholder'=>'Декан' ) ) }}
        </div>
    </div>

@stop

@section('form-additional-block')
    <a href="{{route('faculties', $university->id)}}" class="btn btn-danger">Назад</a>
@stop
