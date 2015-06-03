@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Опитування
@stop

@section('breadcrumbs')
    <li class="active">Опитування</li>
@stop

@section('content')

    <div class="pull-right">
        @if (allowed('polls', 'new'))
        <a href="{{action($module .'@getNew')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Додати</a>
        @endif
    </div>

    <h1>Опитування</h1>

    {{-- The error / success messaging partial --}}
    @include('laravel-bootstrap::partials.messaging')

    @if( !$items->isEmpty() )
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Назва</th>
                    <th>Початок</th>
                    <th>Завершення</th>
                    <th class="options-200">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->title}}</td>
                        <td>{{date("d.m.Y, H:i", $item->time_start)}}</td>
                        <td>{{date("d.m.Y, H:i", $item->time_end)}}</td>
                        <td>
                            <div class="btn-group">
                                @if (allowed('polls', 'edit'))
                                <a href="{{$edit_url.$item->id}}" class="btn btn-default btn-xs">
                                <i class="glyphicon glyphicon-edit"></i></a>
                                @endif
                                @if (allowed('polls', 'delete'))
                                <a href="{{$delete_url.$item->id.'/?token='.Hash::make('delete')}}" class="js-delete btn btn-danger btn-xs" data-message="Видалити?"><i class="glyphicon glyphicon-trash"></i></a>
                                @endif
                                @if (allowed('pollsAnswers', 'new'))
                                <a href="/admin/polls-answers/new/?poll_id={{$item->id}}" class="btn btn-default btn-xs"> <i class="icon icon-plus"></i></a>
                                @endif
                                @if (allowed('pollsAnswers', 'index'))
                                <a href="/admin/polls-answers/{{$item->id}}" class="btn btn-default btn-xs">Варіанти</a>
                                @endif
                                @if ($item->lang_id == $hidden_lang->id)
                                    <a href="{{action($module.'@getNew', ['lang_code' => $default_lang->code, 'id' => $item->id])}}" class="btn btn-xs btn-default"><i class="icon icon-plus"> Створити запис</i></a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">
            <strong>Список порожній</strong>
        </div>
    @endif
    <div class="pull-left">
        {{$items->links()}}
    </div>
@stop
