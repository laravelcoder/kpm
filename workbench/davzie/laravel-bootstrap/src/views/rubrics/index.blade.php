@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Рубрики
@stop

@section('breadcrumbs')
    <li class="active">Рубрики</li>
@stop

@section('content')

    <div class="pull-right">
        @if (allowed('rubrics', 'new'))
        <a href="{{action($module .'@getNew')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Додати</a>
        @endif
    </div>

    <h1>Рубрики</h1>

    {{-- The error / success messaging partial --}}
    @include('laravel-bootstrap::partials.messaging')

    @if( !$items->isEmpty() )
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Назва</th>
                    <th class="options-200">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td><a href="{{$edit_url . $item->id}}">{{$item->title}}</a></td>
                        <td>
                            <div class="btn-group">
                                @if (allowed('rubrics', 'edit'))
                                <a href="{{$edit_url.$item->id}}" class="btn btn-default btn-xs">
                                <i class="glyphicon glyphicon-edit"></i></a>
                                @endif
                                @if (allowed('rubrics', 'delete'))
                                <a href="{{$delete_url.$item->id.'/?token='.Hash::make('delete')}}" class="js-delete btn btn-danger btn-xs" data-message="Видалити?"><i class="glyphicon glyphicon-trash"></i></a>
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
