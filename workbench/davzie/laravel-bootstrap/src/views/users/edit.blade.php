@extends('laravel-bootstrap::layouts.interface-edit-multi')

@section('title')
    Редагування користувача: {{ $item->full_name }}
@stop

@section('breadcrumbs')
    <li><a href="{{$object_url}}">Користувачі</a></li>
    <li class="active">Редагування користувача</li>
@stop

@section('heading')
    <h1>Редагування користувача: <small>{{ $item->full_name }}</small></h1>
@stop

@section('side-menu')
    <li class="active"><a href="#">Редагування</a></li>
    <li><a href="{{$object_url . '/password/' . $item->id}}">Зміна паролю</a></li>
@stop

@section('form-items')

    {{ Form::open( array( 'url'=>$edit_url.$item->id , 'class'=>'form-horizontal form-top-margin' , 'role'=>'form', 'id'=>'item-form' ) ) }}

        {{-- The error / success messaging partial --}}
        @include('laravel-bootstrap::partials.messaging')

        <div class="tab-content">
            <div class="tab-pane active" id="main">

                <h3>Загальна інформація</h3>
                {{-- The first name form item --}}
                <div class="form-group">
                    {{ Form::label( "first_name" , 'Ім\'я' , array( 'class'=>'col-lg-2 control-label' ) ) }}
                    <div class="col-lg-10">
                        {{ Form::text( "first_name" , Input::old( "first_name", $item->first_name ) , array( 'class'=>'form-control' , 'placeholder'=>'Введіть ім\'я' ) ) }}
                    </div>
                </div>

                {{-- The last name form item --}}
                <div class="form-group">
                    {{ Form::label( "last_name" , 'Прізвище' , array( 'class'=>'col-lg-2 control-label' ) ) }}
                    <div class="col-lg-10">
                        {{ Form::text( "last_name" , Input::old( "last_name", $item->last_name ) , array( 'class'=>'form-control' , 'placeholder'=>'Введіть прізвище' ) ) }}
                    </div>
                </div>

                {{-- The email form item --}}
                <div class="form-group">
                    {{ Form::label( "email" , 'Email' , array( 'class'=>'col-lg-2 control-label' ) ) }}
                    <div class="col-lg-10">
                        {{ Form::text( "email" , Input::old( "email", $item->email ) , array( 'class'=>'form-control' , 'placeholder'=>'Email' ) ) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label( "email" , 'Активний' , array( 'class'=>'col-lg-2 control-label' ) ) }}
                    <div class="col-lg-10">
                        {{Form::hidden('is_active', 0)}}
                        {{ Form::checkbox( "is_active" , Input::old("is_active", 1), $item->is_active , array() ) }}
                    </div>
                </div>

                <h3>Ролі</h3>

                <div class="form-group">
                    {{ Form::label( "role_id" , 'Ролі' , array( 'class'=>'col-lg-2 control-label' ) ) }}
                    <div class="col-lg-10">
                        {{ Form::select( "role_id[]" , $roles, Input::old('role_id[]', $item->roles), array('class' => 'form-control sel2', 'multiple') ) }}
                    </div>
                </div>
            </div>
        </div>
        @yield('form-additional-block')
        {{ Form::submit('Зберегти' , array('class'=>'btn btn-large btn-primary')) }}

    {{ Form::close() }}
@stop