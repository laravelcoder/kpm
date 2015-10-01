@extends('laravel-bootstrap::layouts.interface')

@section('title')
    {{$poll->title}}
@stop

@section('breadcrumbs')
    <li><a href="/admin/polls">Опитування</a></li>
    <li class="active">{{$poll->title}}</li>
@stop

@section('content')

    <div class="pull-right">
        @if (allowed('pollsAnswers', 'new'))
        <a href="{{action($module .'@getNew')}}/?poll_id={{$poll->id}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Додати</a>
        @endif
    </div>

    <h1>{{$poll->title}}</h1>

    {{-- The error / success messaging partial --}}
    @include('laravel-bootstrap::partials.messaging')

    <style>
    	ul.can-sort { list-style: none; padding: 0px; width: 80%;}
    	ul.can-sort:not(#sortable) li { padding: 8px; margin-top: 2px;}
		#sortable { list-style: none; list-style-type: none; margin: 0; padding: 0; width: 80%; }
		#sortable li { margin: 0 3px 3px 3px; padding: 4px; padding-left: 1.5em; font-size: 1.4em; cursor: all-scroll; list-style: none;}
		#sortable li span { font-size: 14px; margin-left: -1.3em; }
		.ui-state-highlight { height: 1.5em; line-height: 1.2em; }
	</style>

    @if( !$poll->answers->isEmpty() )
    	@if (allowed('pollsAnswers', 'sort'))
    		<div class="alert alert-info">Для сортування перемістіть елементи</div>
    	@endif
        <form action="" name="sort">
        <ul class="can-sort" @if (allowed('pollsAnswers', 'sort')) id="sortable" data-url="/admin/polls-answers/sort" @endif >
        	@foreach ($poll->answers as $item)
        		<li class="ui-state-default">
        			<span>{{$item->title}} (Голосів: {{$item->votes->count()}})</span>
        			<input type="hidden" name="sort[]" value="{{$item->id}}">
					<div class="btn-group pull-right" style="margin-top: 3px; margin-right: 3px; color: #fff;">
                        @if (allowed('pollsAnswers', 'edit'))
                            <a href="{{$edit_url.$item->id}}" class="btn btn-default btn-xs"><i class="icon icon-pencil"></i></a>
                        @endif
                        @if (allowed('pollsAnswers', 'delete'))
                            <a href="{{$delete_url.$item->id.'/?token='.Hash::make('delete')}}" class="js-delete btn btn-danger btn-xs" data-message="Видалити?" style="color: #fff;"><i class="glyphicon glyphicon-trash"></i></a>
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
@stop