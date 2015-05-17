@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Сторінки
@stop

@section('breadcrumbs')
    <li class="active">Сторінки</li>
@stop

@section('content')

    <div class="pull-right">
        @if (allowed('pages', 'new'))
        <a href="{{action($module .'@getNew')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Додати</a>
        @endif
    </div>

    <h1>Сторінки</h1>

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
                        <td><a href="{{$edit_url . $item->id}}">{{$item->title}}</a>
                        <td>
                            <div class="btn-group">
                                @if (allowed('pages', 'edit'))
                                    <a href="{{$edit_url.$item->id}}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                @endif
                                @if (allowed('pages', 'delete'))
                                    <a href="{{$delete_url.$item->id.'/?token='.Hash::make('delete')}}" class="js-delete btn btn-danger btn-xs" data-message="Видалити?"><i class="glyphicon glyphicon-trash"></i></a>
                                @endif
                                @if (allowed('pages', 'new'))
                                    @if ($item->lang_id == $hidden_lang->id)
                                        <a href="{{action($module.'@getNew', ['lang_code' => $default_lang->code, 'id' => $item->id])}}" class="btn btn-xs btn-default"><i class="icon icon-plus"> Створити запис</i></a>
                                    @endif
                                @endif
                                @if (allowed('pages', 'index'))
                                    <a href="{{action($module.'@getIndex', ['id' => $item->id])}}" class="btn btn-xs btn-default">Підсторінки</a>
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
    <div>
        @if (!empty($page))
            <a href="{{$object_url . '/' . $page->parent_id}}" class="btn btn-primary">Назад</a>
        @endif
    </div>
@stop
