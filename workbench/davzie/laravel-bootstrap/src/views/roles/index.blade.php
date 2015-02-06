@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Ролі
@stop

@section('breadcrumbs')
    <li class="active">Ролі</li>
@stop

@section('content')

    <h1>Ролі</h1>

    {{-- The error / success messaging partial --}}
    @include('laravel-bootstrap::partials.messaging')

    @if( !$items->isEmpty() )
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Назва</th>
                    <th>Ключ</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td><a href="{{$edit_url.$item->id}}">{{$item->name}}</a></td>
                        <td><a href="{{$edit_url.$item->id}}">{{$item->key}}</a>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Опції <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    @if (allowed('roles', 'edit'))
                                    <li><a href="{{$edit_url.$item->id}}">
                                    <i class="glyphicon glyphicon-edit"></i> Редагувати</a></li>
                                    @endif
                                    @if (allowed('roles', 'delete'))
                                    <li><a href="{{$delete_url.$item->id.'/?token='.Hash::make('delete')}}"><i class="glyphicon glyphicon-trash"></i> Видалити</a></li>
                                    @endif
                                    <li class="divider"></li>
                                    @if (allowed('roles', 'permissions'))
                                    <li><a href="{{$object_url.'/permissions/'.$item->id}}">Права</a></li>
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
        @if (allowed('roles', 'new'))
        <a href="{{$new_url}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Додати</a>
        @endif
    </div>
@stop
