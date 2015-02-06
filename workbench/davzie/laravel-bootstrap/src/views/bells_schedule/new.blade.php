@extends('laravel-bootstrap::layouts.interface-new')

@section('title')
    Додавання розкладу дзвінків
@stop

@section('breadcrumbs')
    <li><a href="{{route('universities')}}">Університети</a></li>
    <li class="active">{{$university->name}}</li>
    <li class=""><a href="{{route('bellsSchedule', $university->id)}}">Розклад дзвінків</a></li>
    <li class="active">Редагування розкладу дзвінків</li>
@stop

@section('heading')
    <h1>Додавання розкладу дзвінків <small>{{$university->name}}</small></h1>
@stop

@section('form-items')
    <div class="form-group">
        <div class="col-lg-10">
            {{Form::hidden('university_id', Input::old("university_id", $university->id),array( 'class'=>'form-control'))}}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "title" , 'Номер пари' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "title" , Input::old( "title" ) , array( 'class'=>'form-control' , 'placeholder'=>'Номер пари' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "time_start" , 'Час початку' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "time_start" , Input::old( "time_start" ) , array( 'class'=>'form-control timepicker' , 'placeholder'=>'Час початку' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "time_end" , 'Час завершення' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "time_end" , Input::old( "time_end" ) , array( 'class'=>'form-control timepicker' , 'placeholder'=>'Час завершення' ) ) }}
        </div>
    </div>

@stop

@section('form-additional-block')
    <a href="{{route('bellsSchedule', $university->id)}}" class="btn btn-danger">Назад</a>
@stop
