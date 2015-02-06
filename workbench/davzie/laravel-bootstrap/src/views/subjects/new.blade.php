@extends('laravel-bootstrap::layouts.interface-new')

@section('title')
    Додавання предмету
@stop

@section('breadcrumbs')
    <li><a href="{{route('universities')}}">Університети</a></li>
    <li class="active">{{$university->name}}</li>
    <li class=""><a href="{{route('subjects', $university->id)}}">Список предметів</a></li>
    <li class="active">Додавання предмету</li>
@stop

@section('heading')
    <h1>Додавання предмету <small>{{$university->name}}</small></h1>
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

@stop

@section('form-additional-block')
    <a href="{{route('subjects', $university->id)}}" class="btn btn-danger">Назад</a>
@stop
