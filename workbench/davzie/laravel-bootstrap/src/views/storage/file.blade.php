@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Перегляд файлу
@stop

@section('breadcrumbs')
    <li><a href="{{action($module . '@getIndex', array($file->parent_id))}}">Файли</a></li>
    <li class="active">{{$file->filename}}</li>
@stop

@section('content')
    {{-- The error / success messaging partial --}}
    @include('laravel-bootstrap::partials.messaging')

    <div class="well">
        <img src="{{$file->path}}" class="thumbnail pull-left" width="100" height="100" alt="">
        <div style="margin-left:5px; display: inline-block;">
            <h1> Файл {{$file->filename}}</h1>
            <div style="">
                <b>Тип файлу</b>: {{$file->type}} <br>
                <b>Розмір</b>: {{$file->size}} <br>
                <b>Опис</b>: {{$file->descr}} <br>
            </div>
        </div>
    </div>
    <div class="well">
        <h5><b>Файл прикріплено до:</b></h5>
        <div>
            <div><b>Новини</b></div>
            <ul class="list-group">
                @foreach ($file->news as $new)
                    <li class="list-group-item">{{$new->title}}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <div>
        <a href="{{action($module . '@getIndex', array($file->parent_id))}}" class="btn btn-primary">Назад</a>
        @if (allowed('storage', 'delete'))
        <a href="{{action($module . '@getDelete', array($file->id))}}" class="btn btn-danger js-delete" data-message="Видалити цей файл?">Видалити</a>
        @endif
    </div>
@stop
