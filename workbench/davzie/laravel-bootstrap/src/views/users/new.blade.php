@extends('laravel-bootstrap::layouts.interface-new')

@section('title')
    Створення нового користувача
@stop

@section('breadcrumbs')
    <li><a href="{{$object_url}}">Користувачі</a></li>
    <li class="active">Створення нового користувача</li>
@stop

@section('heading')
    <h1>Створення нового користувача</h1>
@stop

@section('form-items')

    <h3>Загальна інформація</h3>

    {{-- The first name form item --}}
    <div class="form-group">
        {{ Form::label( "first_name" , 'Ім\'я' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "first_name" , Input::old( "first_name" ) , array( 'class'=>'form-control' , 'placeholder'=>'Введіть ім\'я' ) ) }}
        </div>
    </div>

    {{-- The last name form item --}}
    <div class="form-group">
        {{ Form::label( "last_name" , 'Прізвище' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "last_name" , Input::old( "last_name" ) , array( 'class'=>'form-control' , 'placeholder'=>'Введіть прізвище' ) ) }}
        </div>
    </div>

    {{-- The email form item --}}
    <div class="form-group">
        {{ Form::label( "email" , 'Email' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "email" , Input::old( "email" ) , array( 'class'=>'form-control' , 'placeholder'=>'Email' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "email" , 'Активний' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{Form::hidden('is_active', 0)}}
            {{ Form::checkbox( "is_active" , Input::old("is_active", 1)) }}
        </div>
    </div>

    <h3>Авторизація</h3>

    {{-- The password form item --}}
    <div class="form-group">
        {{ Form::label( "password" , 'Пароль' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::password( "password" , array( 'class'=>'form-control' , 'placeholder'=>'Введіть пароль' ) ) }}
        </div>
    </div>

    {{-- The password confirmation form item --}}
    <div class="form-group">
        {{ Form::label( "password_confirmation" , 'Підтвердження пароля' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::password( "password_confirmation" , array( 'class'=>'form-control' , 'placeholder'=>'Введіть ще раз пароль' ) ) }}
        </div>
    </div>

    <h3>Ролі</h3>

    <div class="form-group">
        {{ Form::label( "role_id" , 'Ролі' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::select( "role_id[]" , $roles, Input::old('role_id[]'), array('class' => 'form-control sel2', 'multiple') ) }}
        </div>
    </div>
@stop