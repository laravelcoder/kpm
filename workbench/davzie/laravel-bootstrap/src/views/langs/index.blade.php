@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Мови
@stop

@section('breadcrumbs')
    <li class="active">Мови</li>
@stop

@section('content')

    <div class="pull-right">
        @if (allowed('langs', 'new'))
        <a href="{{action($module .'@getNew')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Додати</a>
        @endif
    </div>
    <h1>Мови</h1>

    {{-- The error / success messaging partial --}}
    @include('laravel-bootstrap::partials.messaging')

    @if( !$items->isEmpty() )
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Назва</th>
                    <th>Код</th>
                    <th>Увімкнена</th>
                    <th>За замовчуванням</th>
                    <th class="options-200">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td><a href="{{$edit_url . $item->id}}">{{$item->name}}</a>
                        <td>{{$item->code}}</td>
                        <td>
                            @if ($item->is_active)
                                Так
                            @else
                                Ні
                            @endif
                        </td>
                        <td>
                            @if ($item->is_default)
                                Так
                            @else
                                Ні
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                @if (allowed('langs', 'edit'))
                                <a href="{{$edit_url.$item->id}}" class="btn btn-xs btn-default">
                                <i class="glyphicon glyphicon-edit"></i></a>
                                @endif
                                @if (allowed('langs', 'delete'))
                                <a href="{{$delete_url.$item->id.'/?token='.Hash::make('delete')}}" class="js-delete btn btn-xs btn-danger" data-message="Видалити?"><i class="glyphicon glyphicon-trash"></i></a>
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
