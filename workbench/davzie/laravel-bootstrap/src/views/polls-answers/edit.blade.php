@extends('laravel-bootstrap::layouts.interface-edit')

@section('title')
    Редагування відповіді
@stop

@section('breadcrumbs')
    <li><a href="/admin/polls">Опитування</a></li>
    <li><a href="{{action($module . '@getIndex')}}">Відповіді</a></li>
    <li class="active">Редагування відповіді</li>
@stop

@section('heading')
    <h1>Редагування відповіді</h1>
    <h2><small>Опитування: {{$item->poll->title}}</small></h2>
@stop

@section('form-items')

    <div class="form-group">
        {{ Form::label( "title" , 'Назва' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "title" , Input::old( "title", $item->title ) , array( 'class'=>'form-control' , 'placeholder'=>'Назва') ) }}
        </div>
    </div>

    {{Form::hidden('lang_id', Input::old('lang_id', $item->lang_id), array())}}
    {{Form::hidden('poll_id', $item->poll->id, array())}}
    {{Form::hidden('_r_url', '/admin/polls-answers/'.$item->poll->id)}}

    <div class="form-group">
        {{ Form::label( "is_active" , 'Активна' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{Form::hidden('is_active', 0)}}
            {{ Form::checkbox( "is_active" , Input::old("is_active", 1), $item->is_active) }}
        </div>
    </div>

@stop

@section('langs-block')
    @if (isset($langs))
		@include('laravel-bootstrap::partials.langs', ['langs' => $langs, 'lang_id' => $item->lang_id, 'id' => $item->id, '_get' => ['poll_id' => $item->poll->id]])
	@endif
@overwrite

@section('form-additional-block')
    <a href="{{action($module . '@getIndex', array($item->poll->id))}}" class="btn btn-danger">Назад</a>
@stop