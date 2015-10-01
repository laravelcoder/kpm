@extends('laravel-bootstrap::layouts.interface-new')

@section('title')
    Створення нового користувача
@stop

@section('breadcrumbs')
    <li><a href="{{$object_url}}">Користувачі</a></li>
    <li class="active">Створення нового користувача</li>
@stop

@section('heading')
    <h1>Надіслати заявку на реєстрацію</h1>
@stop

@section('form-items')

    <h3>Загальна інформація</h3>


    {{-- The email form item --}}
    <div class="form-group">
        {{ Form::label( "email" , 'Email' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "email" , Input::old( "email" ) , array( 'class'=>'form-control' , 'placeholder'=>'Email' ) ) }}
        </div>
    </div>

    <h3>Ролі</h3>

    <div class="form-group">
        {{ Form::label( "roles" , 'Ролі' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::select( "roles[]" , $roles, Input::old('roles[]'), array('class' => 'form-control sel2', 'multiple') ) }}
        </div>
    </div>
@stop