@extends('laravel-bootstrap::layouts.interface-edit')

@section('title')
    Редагування опитування
@stop

@section('breadcrumbs')
    <li><a href="{{action($module . '@getIndex')}}">Опитування</a></li>
    <li class="active">Редагування опитування</li>
@stop

@section('heading')
    <h1>Редагування опитування</h1>
@stop

@section('form-items')

    <div class="form-group">
        {{ Form::label( "title" , 'Назва' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "title" , Input::old( "title", $item->title ) , array( 'class'=>'form-control' , 'placeholder'=>'Назва') ) }}
        </div>
    </div>

    {{Form::hidden('lang_id', Input::old('lang_id', $item->lang_id), array())}}

    <div class="form-group">
        {{ Form::label( "time_start" , 'Початок' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "time_start" , Input::old( "time_start", date('d-m-Y, H:i',$item->time_start) ) , array( 'class'=>'form-control datetimepicker' , 'placeholder'=>'Початок' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "time_end" , 'Завершення' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "time_end" , Input::old( "time_end", date('d-m-Y, H:i',$item->time_end) ) , array( 'class'=>'form-control datetimepicker' , 'placeholder'=>'Завершення' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "is_active" , 'Активне' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{Form::hidden('is_active', 0)}}
            {{ Form::checkbox( "is_active" , Input::old("is_active", 1), $item->is_active) }}
        </div>
    </div>

@stop

@section('form-additional-block')
    <a href="{{action($module . '@getIndex')}}" class="btn btn-danger">Назад</a>
@stop