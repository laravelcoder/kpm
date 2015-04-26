@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Оголошення
@stop

@section('breadcrumbs')
    <li class="active">Оголошення</li>
@stop

@section('content')

    <h1>Оголошення</h1>

    {{-- The error / success messaging partial --}}
    @include('laravel-bootstrap::partials.messaging')

    @if( !$items->isEmpty() )
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Фото</th>
                    <th>Назва</th>
                    <th>Дата початку</th>
                    <th>Дата завершення</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td><img src="{{$item->thumbs['100x']}}" alt="" width="60" height="60" class="thumbnail"></td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->time_start}}</td>
                        <td>{{$item->time_end}}</td>
                        <td>
                            <div class="btn-group">
                            	@if (allowed('adverts', 'view'))
                                	<a href="{{action($module.'@getView', array($item->id))}}" class="btn btn-default btn-xs"><i class="icon icon-eye-open"></i></a>
                                @endif
                                @if (allowed('adverts', 'edit'))
                                    <a href="{{$edit_url.$item->id}}" class="btn btn-default btn-xs"><i class="icon icon-pencil"></i></a>
                                @endif
                                @if (allowed('adverts', 'delete'))
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
    <div class="pull-right">
        @if (allowed('adverts', 'new'))
        <a href="{{action($module .'@getNew')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Додати</a>
        @endif
    </div>
@stop