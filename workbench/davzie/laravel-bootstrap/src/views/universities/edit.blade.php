@extends('laravel-bootstrap::layouts.interface-edit-multi')

@section('title')
    Редагування університету: {{ $item->name }}
@stop

@section('heading')
    <h1>Редагування університету: <small>{{ $item->name }}</small></h1>
@stop

@section('side-menu')
    <li class="active"><a href="#">Редагування</a></li>
    @if (allowed('universities', 'access'))<li><a href="{{$object_url . '/access/' . $item->id}}">Доступ</a></li>@endif
@stop

@section('form-items')

    {{ Form::open( array( 'url'=>$edit_url.$item->id , 'class'=>'form-horizontal form-top-margin' , 'role'=>'form', 'id'=>'item-form' ) ) }}

        {{-- The error / success messaging partial --}}
        @include('laravel-bootstrap::partials.messaging')

        <div class="tab-content">
            <div class="tab-pane active" id="main">
                <div class="form-group">
                    {{ Form::label( "name" , 'Назва' , array( 'class'=>'col-lg-2 control-label' ) ) }}
                    <div class="col-lg-10">
                        {{ Form::text( "name" , Input::old( "name" , $item->name ) , array( 'class'=>'form-control' , 'placeholder'=>'Post Title' ) ) }}
                    </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label( "adress" , 'Адреса' , array( 'class'=>'col-lg-2 control-label' ) ) }}
                        <div class="col-lg-10">
                            {{ Form::text( "adress" , Input::old( "adress" , $item->adress ) , array( 'class'=>'form-control' , 'placeholder'=>'Post Title' ) ) }}
                        </div>
                    </div>
            </div>
        </div>

        {{ Form::submit('Зберегти' , array('class'=>'btn btn-large btn-primary')) }}

    {{ Form::close() }}



@stop
