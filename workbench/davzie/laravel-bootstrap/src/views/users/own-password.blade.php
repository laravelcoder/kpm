@extends('laravel-bootstrap::layouts.interface-edit-multi')

@section('title')
    Зміна паролю
@stop


@section('heading')
    <h1>Зміна паролю <small>{{ $item->full_name }}</small></h1>
@stop

@section('side-menu')
    <li ><a href="{{$object_url . '/profile/'}}">Редагування профілю</a></li>
    <li class="active"><a href="#">Зміна паролю</a></li>
@stop

@section('form-items')

    {{ Form::open( array('class'=>'form-horizontal form-top-margin' , 'role'=>'form', 'id'=>'item-form' ) ) }}

        {{-- The error / success messaging partial --}}
        @include('laravel-bootstrap::partials.messaging')

        <div class="tab-content">
            <div class="tab-pane active" id="main">
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
            </div>
        </div>
        @yield('form-additional-block')
        {{ Form::submit('Зберегти' , array('class'=>'btn btn-large btn-primary')) }}

    {{ Form::close() }}
@stop