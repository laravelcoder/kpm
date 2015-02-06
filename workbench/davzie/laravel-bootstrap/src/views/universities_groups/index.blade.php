@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Список груп університетів
@stop

@section('breadcrumbs')
    <li class="active">Групи університетів</li>
@stop

@section('content')

    <h1>Групи університетів</h1>
    <p>Posts can be anything from blog posts, news items to event listings. Essentially they're a timestamp ordered list of content entries with images.</p>

    {{-- The error / success messaging partial --}}
    @include('laravel-bootstrap::partials.messaging')

    @if( !$items->isEmpty() )
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Назва</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td><a href="{{$edit_url.$item->id}}">{{$item->id}}</a></td>
                        <td><a href="{{$edit_url.$item->id}}">{{$item->title}}</a>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Опції <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li><a href="{{$edit_url.$item->id}}">
                                    <i class="glyphicon glyphicon-edit"></i> Редагувати</a></li>
                                    <li><a href="{{$delete_url.$item->id}}"><i class="glyphicon glyphicon-trash"></i> Видалити</a></li>
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
        <a href="{{$new_url}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Додати</a>
    </div>
@stop
