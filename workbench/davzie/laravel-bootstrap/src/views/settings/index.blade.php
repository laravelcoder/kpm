@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Налаштування
@stop

@section('breadcrumbs')
    <li class="active">Налаштування</li>
@stop

@section('content')

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
                    <th>&nbsp;</th>
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
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Опції <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    @if (allowed('settings', 'edit'))
                                    <li><a href="{{$edit_url.$item->id}}">
                                    <i class="glyphicon glyphicon-edit"></i> Редагувати</a></li>
                                    @endif
                                    @if (allowed('settings', 'delete'))
                                    <li><a href="{{$delete_url.$item->id.'/?token='.Hash::make('delete')}}" class="js-delete" data-message="Видалити?"><i class="glyphicon glyphicon-trash"></i> Видалити</a></li>
                                    @endif
                                </ul>
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
    <div class="pull-right">
        @if (allowed('settings', 'new'))
        <a href="{{action($module .'@getNew')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Додати</a>
        @endif
    </div>

@stop