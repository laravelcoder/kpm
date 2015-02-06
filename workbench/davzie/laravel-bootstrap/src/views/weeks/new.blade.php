@extends('laravel-bootstrap::layouts.interface-new')

@section('title')
    Додавання тижня навчання
@stop

@section('breadcrumbs')
    <li><a href="{{route('universities')}}">Університети</a></li>
    <li class="active">{{$university->name}}</li>
    <li class=""><a href="{{route('weeks', $university->id)}}">Тижні навчання</a></li>
    <li class="active">Додавання тижня навчання</li>
@stop

@section('heading')
    <h1>Додавання тижня навчання <small>{{$university->name}}</small></h1>
@stop

@section('form-items')
    <div class="form-group">
        <div class="col-lg-10">
            {{Form::hidden('university_id', Input::old("university_id", $university->id),array( 'class'=>'form-control'))}}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "title" , 'Тиждень' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "title" , Input::old( "title" ) , array( 'class'=>'form-control' , 'placeholder'=>'Тиждень' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "time_start" , 'Дата початку' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "time_start" , Input::old( "time_start" ) , array( 'class'=>'form-control datepicker' , 'placeholder'=>'Дата початку' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "time_end" , 'Дата завершення' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "time_end" , Input::old( "time_end" ) , array( 'class'=>'form-control datepicker' , 'placeholder'=>'Дата завершення' ) ) }}
        </div>
    </div>

@stop

@section('form-additional-block')
    <a href="{{route('weeks', $university->id)}}" class="btn btn-danger">Назад</a>
@stop
