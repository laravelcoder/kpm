@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Ролі
@stop

@section('breadcrumbs')
    <li class="active">Ролі</li>
@stop

@section('content')

    <div class="pull-right">
        @if (allowed('roles', 'new'))
        <a href="{{$new_url}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Додати</a>
        @endif
    </div>
    <h1>Ролі</h1>

    {{-- The error / success messaging partial --}}
    @include('laravel-bootstrap::partials.messaging')

    @if( !$items->isEmpty() )
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Назва</th>
                    <th>Ключ</th>
                    <th class="options-200">&nbsp;</th>
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
                                @if (allowed('roles', 'edit'))
                                    <a href="{{$edit_url.$item->id}}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-edit"></i></a>
                                @endif
                                @if (allowed('roles', 'delete'))
                                    <a href="{{$delete_url.$item->id.'/?token='.Hash::make('delete')}}" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
                                @endif
                                @if (allowed('roles', 'permissions'))
                                    <a href="{{$object_url.'/permissions/'.$item->id}}" class="btn btn-xs btn-primary">Права</a>
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
