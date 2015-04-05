@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Список викладачів
@stop

@section('breadcrumbs')
    <li><a href="{{route('universities')}}">Університети</a></li>
    <li class="active">{{$department->faculty->university->name}}</li>
    <li class=""><a href="{{route('faculties', $department->faculty->university->id)}}">Факультети</a></li>
    <li class=""><a href="{{route('departments', $department->faculty->id)}}">Кафедри</a></li>
    <li class="active">Список викладачів</li>
@stop

@section('content')

    <h1>Список викладачів: <small>{{$department->title}}</small></h1>
    <h2>Факультет: {{$department->faculty->title}}</h2>

    {{-- The error / success messaging partial --}}
    @include('laravel-bootstrap::partials.messaging')

    @if( !$items->isEmpty() )
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>П. І. Б.</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td><a href="{{$edit_url.$item->id}}">{{$item->surname}} {{$item->name}} {{$item->last_name}}</a>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Опції <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    @if (allowed('teachers', 'edit'))
                                    <li><a href="{{$edit_url.$item->id}}">
                                    <i class="glyphicon glyphicon-edit"></i> Редагувати</a></li>
                                    @endif
                                    @if (allowed('teachers', 'delete'))
                                    <li><a href="{{$delete_url.$item->id.'/?token='.Hash::make('delete')}}" class="js-delete" data-message="Видалити?"><i class="glyphicon glyphicon-trash"></i> Видалити</a></li>
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
        @if (allowed('teachers', 'new'))
        <a href="{{route('teacherAdd', $id)}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Додати</a>
        @endif
    </div>
@stop
