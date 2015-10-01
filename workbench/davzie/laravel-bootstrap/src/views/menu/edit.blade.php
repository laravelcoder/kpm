@extends('laravel-bootstrap::layouts.interface-edit')

@section('title')
    Редагування пункту меню
@stop

@section('breadcrumbs')
    <li><a href="{{action($module . '@getIndex', ['id' => $item->parent_id])}}">Меню</a></li>
    <li class="active">Редагування пункту меню</li>
@stop

@section('heading')
    <h1>Редагування пункту меню</h1>
@stop

@section('form-items')

    <div class="form-group">
        {{ Form::label( "title" , 'Назва' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "title" , Input::old( "title", $item->title ) , array( 'class'=>'form-control' , 'placeholder'=>'Назва') ) }}
        </div>
    </div>

    {{Form::hidden('lang_id', Input::old('lang_id', $item->lang_id), array())}}

    <div class="form-group">
        {{ Form::label( "link" , 'URL Адреса' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::text( "link" , Input::old( "link", $item->link ) , array( 'class'=>'form-control' , 'placeholder'=>'Адреса' ) ) }}
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
    				<option value="@if ($_lang_code != $default_lang->code)/{{$_lang_code}}@endif/{{$page->slug}}">{{$page->title}}</option>
    			@endforeach
    		</select>
    	</div>
    </div>

    <div class="form-group">
        {{ Form::label( "parent_id" , 'Батьківський пункт' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::select( "parent_id", ['' => ''] + $items, Input::old( "parent_id", $item->parent_id ) , array( 'class'=>'form-control' , 'placeholder'=>'Батьківська сторінка' ) ) }}
        </div>
    </div>

@stop

@section('form-additional-block')
    <a href="{{action($module . '@getIndex', ['id' => null])}}" class="btn btn-danger">Назад</a>
@stop