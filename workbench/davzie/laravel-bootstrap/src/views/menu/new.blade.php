@extends('laravel-bootstrap::layouts.interface-new')

@section('title')
    Додавання пункту меню
@stop

@section('breadcrumbs')
    <li><a href="{{action($module . '@getIndex')}}">Меню</a></li>
    <li class="active">Додавання пункту меню</li>
@stop

@section('heading')
    <h1>Додавання пункту меню</h1>
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
    {{Form::hidden('order', $default->order ? $default->order : 0)}}

    <div class="form-group">
        {{ Form::label( "link" , 'URL Адреса' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "link" , Input::old( "link", $default->link ) , array( 'class'=>'form-control' , 'placeholder'=>'Адреса' ) ) }}
        </div>
    </div>

    <div class="form-group">
    	<div class="col-lg-2"></div>
    	<div class="col-lg-10">
    		<div style="margin-bottom: 5px;">
    			<a href="#" class="btn btn-xs btn-success js-toggle-element" data-target="select[name=page]">Посилання на сторінку</a>
    		</div>
    		<select name="page" class="form-control js-select-to" data-target="[name=link]" style="display: none;" id="">
    			<option value="">Оберіть сторінку</option>
    			@foreach ($pages as $page)
    				<option value="/{{$_lang_code}}/{{$page->slug}}">{{$page->title}}</option>
    			@endforeach
    		</select>
    	</div>
    </div>

    <div class="form-group">
        {{ Form::label( "parent_id" , 'Батьківський пункт' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::select( "parent_id", ['' => ''] + $items, Input::old( "parent_id", $default->parent_id ) , array( 'class'=>'form-control' , 'placeholder'=>'Батьківська сторінка' ) ) }}
        </div>
    </div>

@stop

@section('form-additional-block')
    <a href="{{action($module . '@getIndex', ['id' => null])}}" class="btn btn-danger">Назад</a>
@stop
