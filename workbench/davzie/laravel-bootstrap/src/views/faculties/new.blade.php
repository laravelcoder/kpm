@extends('laravel-bootstrap::layouts.interface-new')

@section('title')
    Додавання факультету
@stop

@section('breadcrumbs')
    <li><a href="{{route('universities')}}">Університети</a></li>
    <li class="active">{{$university->name}}</li>
    <li class=""><a href="{{route('faculties', $university->id)}}">Факультети</a></li>
    <li class="active">Додавання факультету</li>
@stop

@section('heading')
    <h1>Додавання факультету <small>{{$university->name}}</small></h1>
@stop

@section('form-items')
    <div class="form-group">
        <div class="col-lg-10">
            {{Form::hidden('university_id', Input::old("university_id", $university->id),array( 'class'=>'form-control'))}}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "title" , 'Назва' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "title" , Input::old( "title" ) , array( 'class'=>'form-control' , 'placeholder'=>'Назва' ) ) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "adress" , 'Адреса' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "adress" , Input::old( "adress" ) , array( 'class'=>'form-control' , 'placeholder'=>'Адреса' ) ) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "dean" , 'Декан' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "dean" , Input::old( "dean" ) , array( 'class'=>'form-control' , 'placeholder'=>'Декан' ) ) }}
        </div>
    </div>

@stop

@section('form-additional-block')
    <a href="{{route('faculties', $university->id)}}" class="btn btn-danger">Назад</a>
@stop
