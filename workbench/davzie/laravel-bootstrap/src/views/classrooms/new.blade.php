@extends('laravel-bootstrap::layouts.interface-new')

@section('title')
    Додавання аудиторії
@stop

@section('breadcrumbs')
    <li><a href="{{route('universities')}}">Університети</a></li>
    <li class="active">{{$building->university->name}}</li>
    <li class=""><a href="{{route('buildings', $building->university->id)}}">Навчальні корпуси</a></li>
    <li class=""><a href="{{route('classrooms', $building->id)}}">Список робочих аудиторій</a></li>
    <li class="active">Редагування інформації про аудиторію</li>
@stop

@section('heading')
    <h1>Додавання аудиторії <small>{{$building->name}}</small></h1>
@stop

@section('form-items')
    <div class="form-group">
        <div class="col-lg-10">
            {{Form::hidden('building_id', Input::old("building_id", $building->id),array( 'class'=>'form-control'))}}
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
    <a href="{{route('classrooms', $building->id)}}" class="btn btn-danger">Назад</a>
@stop
