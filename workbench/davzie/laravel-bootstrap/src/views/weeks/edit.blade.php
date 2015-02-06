@extends('laravel-bootstrap::layouts.interface-edit')

@section('title')
    Редагування тижня
@stop

@section('breadcrumbs')
    <li><a href="{{route('universities')}}">Університети</a></li>
    <li class="active">{{$university->name}}</li>
    <li class=""><a href="{{route('bellsSchedule', $university->id)}}">Розклад дзвінків</a></li>
    <li class="active">Редагування тижня</li>
@stop

@section('heading')
    <h1>Редагування тижня <small>{{$university->name}}</small></h1>
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
            {{ Form::text( "title" , Input::old( "title", $item->title ) , array( 'class'=>'form-control' , 'placeholder'=>'Номер пари' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "time_start" , 'Час початку' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "time_start" , Input::old( "time_start", $item->time_start ) , array( 'class'=>'form-control datepicker' , 'placeholder'=>'Час початку' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "time_end" , 'Час завершення' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "time_end" , Input::old( "time_end", $item->time_end ) , array( 'class'=>'form-control datepicker' , 'placeholder'=>'Час завершення' ) ) }}
        </div>
    </div>

@stop

@section('form-additional-block')
    <a href="{{route('weeks', $university->id)}}" class="btn btn-danger">Назад</a>
@stop
