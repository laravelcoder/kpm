@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Список факультетів
@stop

@section('breadcrumbs')
    <li><a href="{{route('universities')}}">Університети</a></li>
    <li class="active">{{$university->name}}</li>
    <li class="active">Факультети</li>
@stop

@section('content')

    <h1>Факультети університету</h1>

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
                                    @if (allowed('faculties', 'edit'))
                                    <li><a href="{{route('facultyEdit', array($item->university_id, $item->id))}}"><i class="glyphicon glyphicon-edit"></i> Редагувати</a></li>@endif
                                    @if (allowed('faculties', 'delete'))
                                    <li><a href="{{$delete_url.$item->id.'/?token='.Hash::make('delete')}}" class="js-delete" data-message="Видалити?"><i class="glyphicon glyphicon-trash"></i> Видалити</a></li>
                                    @endif
                                    <li class="divider"></li>
                                    @if (allowed('departments', 'index'))
                                    <li><a href="{{route('departments', array($item->id))}}">Кафедри</a></li>
                                    @endif
                                    @if (allowed('groups', 'index'))
                                    <li><a href="{{route('groups', array($item->id))}}">Групи</a></li>
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
         @if (allowed('faculties', 'new'))
        <a href="{{route('facultyAdd', $id)}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Додати</a>
        @endif
    </div>
@stop
