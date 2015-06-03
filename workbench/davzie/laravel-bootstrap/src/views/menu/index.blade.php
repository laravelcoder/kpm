@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Меню
@stop

@section('breadcrumbs')
	@if ($id)
		<li><a href="/admin/menu">Меню</a></li>
	@else
    	<li class="active">Меню</li>
    @endif
@stop

@section('content')

    <div class="pull-right">
        @if (allowed('galleries', 'new'))
            <a href="{{action($module .'@getNew')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Додати</a>
        @endif
    </div>

    <h1>Меню</h1>

    {{-- The error / success messaging partial --}}
    @include('laravel-bootstrap::partials.messaging')

    <style>
		#sortable { list-style-type: none; margin: 0; padding: 0; width: 80%; }
		#sortable li { margin: 0 3px 3px 3px; padding: 4px; padding-left: 1.5em; font-size: 1.4em; cursor: all-scroll; }
		#sortable li span { font-size: 14px; margin-left: -1.3em; }
		.ui-state-highlight { height: 1.5em; line-height: 1.2em; }
	</style>

    @if( !$items->isEmpty() )
    	@if (allowed('menu', 'sort'))
    		<div class="alert alert-info">Для сортування перемістіть елементи</div>
    	@endif
        	<form action="" name="sort">
        <ul class="can-sort" @if (allowed('menu', 'sort')) id="sortable" data-url="/admin/menu/sort" @endif >
        	@foreach ($items as $item)
        		<li class="ui-state-default">
        			<span>{{$item->title}}</span>
        			<input type="hidden" name="sort[]" value="{{$item->id}}">
					<div class="btn-group pull-right" style="margin-top: 3px; margin-right: 3px; color: #fff;">
                        @if (allowed('menu', 'edit'))
                            <a href="{{$edit_url.$item->id}}" class="btn btn-default btn-xs"><i class="icon icon-pencil"></i></a>
                        @endif
                        @if (allowed('menu', 'delete'))
                            <a href="{{$delete_url.$item->id.'/?token='.Hash::make('delete')}}" class="js-delete btn btn-danger btn-xs" data-message="Видалити?" style="color: #fff;"><i class="glyphicon glyphicon-trash"></i></a>
                        @endif
                        @if ($item->parent_id == null)
                        	<a href="{{$object_url.'/'.$item->id}}" class="btn btn-xs btn-primary" style="color: #fff;">Підпункти</a>
                        @endif
                        @if ($item->lang_id == $hidden_lang->id)
                            <a href="{{action($module.'@getNew', ['lang_code' => $default_lang->code, 'id' => $item->id])}}" class="btn btn-xs btn-default"><i class="icon icon-plus"> Створити запис</i></a>
                        @endif
	                </div>
	            </li>
        	@endforeach
        </ul>
        	</form>
    @else
        <div class="alert alert-info">
            <strong>Список порожній</strong>
        </div>
    @endif

    @if ($id)
	        <div>
	        	<a href="/admin/menu" class="btn btn-primary">Назад</a>
	        </div>
	    @endif
@stop
