@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Перегляд листа
@stop

@section('breadcrumbs')
    <li><a href="{{action($module . '@getIndex')}}">Зворотній зв`язок</a></li>
    <li class="active">Перегляд листа</li>
@stop

@section('content')
    {{-- The error / success messaging partial --}}
    @include('laravel-bootstrap::partials.messaging')

    <div class="well">
        <div style="margin-left:5px; display: inline-block;">
            <h1> Перегляд листа</h1>
            <div style="">
                <b>Тема</b>: {{$item->subject}} <br>
                <b>Від</b>: {{$item->from}} <br>
                <b>Email</b>: {{$item->email}} <br>
                <b>Повідомлення</b>: {{$item->body}} <br>
            </div>
        </div>
    </div>
    <div>
    	<div class="btn-group">
	        <a href="{{action($module . '@getIndex')}}" class="btn btn-primary">Назад</a>
	        @if (allowed('feedback', 'delete'))
	        	<a href="{{action($module . '@getDelete', array($item->id))}}" class="btn btn-danger js-delete" data-message="Видалити цей файл?">Видалити</a>
	        @endif
	        @if (allowed('feedback', 'toggle'))
	        	<a href="#" data-url="{{action($module.'@postToggle')}}" data-column="is_checked" data-value="{{$item->is_checked ? '1':'0'}}" class="js-toggle-bool-value btn @if ($item->is_checked) btn-primary @else btn-default @endif"><i class="icon icon-checked"></i></a>
	        @endif
	    </div>
    </div>
@stop
