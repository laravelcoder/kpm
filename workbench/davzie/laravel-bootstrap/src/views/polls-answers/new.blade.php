@extends('laravel-bootstrap::layouts.interface-new')

@section('title')
    Додавання відповіді
@stop

@section('breadcrumbs')
    <li><a href="/admin/polls">Опитування</a></li>
    <li><a href="{{action($module . '@getIndex', [$poll->id])}}">Відповіді</a></li>
    <li class="active">Додавання відповіді</li>
@stop

@section('heading')
    <h1>Додавання відповіді</h1>
    <h2><small>Опитування: {{$poll->title}}</small></h2>
@stop

@section('form-items')

    <div class="form-group">
        {{ Form::label( "title" , 'Назва' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "title" , Input::old( "title" ) , array( 'class'=>'form-control' , 'placeholder'=>'Назва') ) }}
        </div>
    </div>

    {{Form::hidden('lang_id', Input::old('lang_id', $lang_id), array())}}
    {{Form::hidden('id', Input::old('id', $id), array())}}
    {{Form::hidden('poll_id', $poll->id, array())}}
    {{Form::hidden('_r_url', '/admin/polls-answers/'.$poll->id)}}

    <div class="form-group">
        {{ Form::label( "is_active" , 'Активна' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{Form::hidden('is_active', 0)}}
            {{ Form::checkbox( "is_active" , Input::old("is_active", 1), $default->is_active) }}
        </div>
    </div>

@stop

@section('langs-block')
    @if (isset($langs))
		@include('laravel-bootstrap::partials.langs', ['langs' => $langs, 'lang_id' => $lang_id, 'id' => $id, '_get' => ['poll_id' => $poll->id]])
	@endif
@overwrite

@section('form-additional-block')
    <a href="{{action($module . '@getIndex', array($poll->id))}}" class="btn btn-danger">Назад</a>
@stop