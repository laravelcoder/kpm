@extends('laravel-bootstrap::layouts.interface-new')

@section('title')
    Додавання сторінки
@stop

@section('breadcrumbs')
    <li><a href="{{action($module . '@getIndex')}}">Сторінки</a></li>
    <li class="active">Додавання сторінки</li>
@stop

@section('heading')
    <h1>Додавання сторінки</h1>
@stop

@section('form-items')

    <div class="form-group">
        {{ Form::label( "title" , 'Назва' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "title" , Input::old( "title" ) , array( 'class'=>'form-control' , 'placeholder'=>'Назва', 'data-slug' => $default->slug ? '':'[name=slug]' ) ) }}
        </div>
    </div>

    {{Form::hidden('lang_id', Input::old('lang_id', $lang_id), array())}}
    {{Form::hidden('id', Input::old('id', $id), array())}}

    <div class="form-group">
        {{ Form::label( "slug" , 'Аліас' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "slug" , Input::old( "slug", $default->slug ) , array( 'class'=>'form-control' , 'placeholder'=>'Аліас' ) ) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "parent_id" , 'Батьківська сторінка' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::select( "parent_id", ['' => ''] + $pages, Input::old( "parent_id", $default->parent_id ) , array( 'class'=>'form-control' , 'placeholder'=>'Батьківська сторінка' ) ) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "body" , 'Контент' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::textarea( "body" , Input::old( "body" ) , array( 'class'=>'form-control rich' , 'placeholder'=>'Контент', 'rows' => 30 ) ) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "is_active" , 'Активна' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{Form::hidden('is_active', 0)}}
            {{ Form::checkbox( "is_active" , Input::old("is_active", 1), $default->is_active) }}
        </div>
    </div>

@stop

@section('form-additional-block')
    <a href="{{action($module . '@getIndex')}}" class="btn btn-danger">Назад</a>
@stop
