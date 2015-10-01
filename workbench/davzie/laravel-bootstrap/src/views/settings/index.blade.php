@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Налаштування
@stop

@section('breadcrumbs')
    <li class="active">Налаштування</li>
@stop

@section('content')

    <div class="pull-right">
        @if (allowed('settings', 'new'))
        <a href="{{action($module .'@getNew')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Додати</a>
        @endif
    </div>

    <h1>Налаштування</h1>

    {{-- The error / success messaging partial --}}
    @include('laravel-bootstrap::partials.messaging')

    @if( !$items->isEmpty() )
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Назва</th>
                    <th>Ключ</th>
                    <th>Значення</th>
                    <th width="100">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td><a href="{{$edit_url . $item->id}}">{{$item->label}}</a></td>
                        <td>{{$item->key}}</td>
                        <td>{{$item->value}}</td>
                        <td>
                            <div class="btn-group">
                                @if (allowed('settings', 'edit'))
                                    <a href="{{$edit_url.$item->id}}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-edit"></i></a>
                                @endif
                                @if (allowed('settings', 'delete'))
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