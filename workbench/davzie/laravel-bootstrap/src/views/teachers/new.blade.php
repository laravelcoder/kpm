@extends('laravel-bootstrap::layouts.interface-new')

@section('title')
    Додавання викладача
@stop

@section('breadcrumbs')
    <li><a href="{{route('universities')}}">Університети</a></li>
    <li class="active">{{$department->faculty->university->name}}</li>
    <li class=""><a href="{{route('faculties', $department->faculty->university->id)}}">Факультети</a></li>
    <li class=""><a href="{{route('departments', $department->faculty->id)}}">Кафедри</a></li>
    <li class=""><a href="{{route('teachers', $department->id)}}">Список викладачів</a></li>
    <li class="active">Додавання викладача</li>
@stop

@section('heading')
    <h1>Додавання викладача <br /><small>{{$department->title}}</small></h1>
@stop

@section('form-items')
    <div class="form-group">
        <div class="col-lg-10">
            {{Form::hidden('department_id', Input::old("department_id", $department->id),array( 'class'=>'form-control'))}}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "surname" , 'Прізвище' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "surname" , Input::old( "surname" ) , array( 'class'=>'form-control' , 'placeholder'=>'Прізвище' ) ) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "name" , 'Ім`я' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "name" , Input::old( "name" ) , array( 'class'=>'form-control' , 'placeholder'=>'Ім`я' ) ) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "last_name" , 'По-батькові' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "last_name" , Input::old( "last_name" ) , array( 'class'=>'form-control' , 'placeholder'=>'По-батькові' ) ) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "graduate" , 'Вчений ступінь' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "graduate" , Input::old( "graduate" ) , array( 'class'=>'form-control' , 'placeholder'=>'Вчений ступінь' ) ) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "about" , 'Додаткова інформація' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::textarea( "about" , Input::old( "about" ) , array( 'class'=>'form-control rich' , 'placeholder'=>'Додаткова інформація' ) ) }}
        </div>
    </div>

@stop

@section('form-additional-block')
    <a href="{{route('teachers', $department->id)}}" class="btn btn-danger">Назад</a>
@stop
