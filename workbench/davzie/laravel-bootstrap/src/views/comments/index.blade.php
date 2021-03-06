@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Коментарі
@stop

@section('breadcrumbs')
    <li class="active">Коментарі</li>
@stop

@section('content')

    <h1>Коментарі</h1>

    {{-- The error / success messaging partial --}}
    @include('laravel-bootstrap::partials.messaging')

    @if( !$items->isEmpty() )
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Імя</th>
                    <th>Коментар</th>
                    <th class="options-200">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->text}}</td>
                        <td>
                            <div class="btn-group">
                                @if (allowed('links', 'edit'))
                                <a href="{{$edit_url.$item->id}}" class="btn btn-default btn-xs">
                                <i class="glyphicon glyphicon-edit"></i></a>
                                @endif
                                @if (allowed('links', 'delete'))
                                <a href="{{$delete_url.$item->id.'/?token='.Hash::make('delete')}}" class="js-delete btn btn-danger btn-xs" data-message="Видалити?"><i class="glyphicon glyphicon-trash"></i></a>
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
