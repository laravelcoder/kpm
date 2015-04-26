@extends('laravel-bootstrap::layouts.interface-edit-multi')

@section('title')
    Редагування профілю
@stop


@section('heading')
    <h1>Редагування профілю: <small>{{ $item->full_name }}</small></h1>
@stop

@section('side-menu')
    <li class="active"><a href="#">Редагування профілю</a></li>
    <li><a href="{{$object_url . '/own-password/'}}">Зміна паролю</a></li>
@stop

@section('form-items')

    {{ Form::open( array('class'=>'form-horizontal form-top-margin' , 'role'=>'form', 'id'=>'item-form' ) ) }}

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

            </div>
        </div>
        @yield('form-additional-block')
        {{ Form::submit('Зберегти' , array('class'=>'btn btn-large btn-primary')) }}

    {{ Form::close() }}
@stop