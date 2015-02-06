@extends('laravel-bootstrap::layouts.interface-new')

@section('title')
    Додавання групи університету
@stop

@section('breadcrumbs')
    <li class=""><a href="{{$object_url}}">Групи університетів</a></li>
    <li class="active">Редагування групи університету</li>
@stop

@section('heading')
    <h1>Додавання групи університету</h1>
@stop

@section('form-items')

    <div class="form-group">
        {{ Form::label( "title" , 'Назва' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "title" , Input::old( "title" ) , array( 'class'=>'form-control' , 'placeholder'=>'Назва' ) ) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "university_id" , 'Університети' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::select( "university_id[]" , $universities, Input::old('university_id[]'), array('class' => 'sel2', 'multiple') ) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label( "user_id" , 'Користувачі' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::select( "user_id[]" , $users, Input::old('user_id[]'), array('class' => 'sel2', 'multiple') ) }}
        </div>
    </div>

@stop
