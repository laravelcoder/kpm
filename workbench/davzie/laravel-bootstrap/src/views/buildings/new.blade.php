@extends('laravel-bootstrap::layouts.interface-new')

@section('title')
    Додавання навчального корпусу
@stop

@section('breadcrumbs')
    <li><a href="{{route('universities')}}">Університети</a></li>
    <li class="active">{{$university->name}}</li>
    <li class=""><a href="{{route('buildings', $university->id)}}">Навчальні корпуси університету</a></li>
    <li class="active">Редагування інформації про навчальний корпус</li>
@stop

@section('heading')
    <h1>Додавання навчального корпусу <small>{{$university->name}}</small></h1>
@stop

@section('form-items')
    <div class="form-group">
        <div class="col-lg-10">
            {{Form::hidden('university_id', Input::old("university_id", $university->id),array( 'class'=>'form-control'))}}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "name" , 'Назва' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "name" , Input::old( "name" ) , array( 'class'=>'form-control' , 'placeholder'=>'Назва' ) ) }}
        </div>
    </div>

@stop

@section('form-additional-block')
    <a href="{{route('buildings', $university->id)}}" class="btn btn-danger">Назад</a>
@stop
