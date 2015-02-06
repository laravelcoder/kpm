@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Користувачі
@stop

@section('breadcrumbs')
    <li class="active">Список користувачів</li>
@stop

@section('content')

    <h1>Користувачі</h1>
    <p>Users are people that have access to the CMS system. Manage them here.</p>
    

    {{-- The error / success messaging partial --}}
    @include('laravel-bootstrap::partials.messaging')
    
    @if( !$items->isEmpty() )
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Email</th>
                    <th>Імя</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td><a href="{{ $edit_url.$item->id }}">{{ $item->id }}</a></td>
                        <td><a href="{{ $edit_url.$item->id }}">{{ $item->email }}</a></td>
                        <td><a href="{{ $edit_url.$item->id }}">{{ $item->full_name }}</a></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Опції <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li><a href="{{$edit_url.$item->id}}">
                                    <i class="glyphicon glyphicon-edit"></i> Редагувати</a></li>
                                    <li><a href="{{$delete_url.$item->id}}" class="js-delete" data-message="Видалити?"><i class="glyphicon glyphicon-trash"></i> Видалити</a></li>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">
            <strong>Список порожній</strong> Немає жодного корстувача
        </div>
    @endif

    <div class="pull-left">
        {{$items->links()}}
    </div>
    <div class="pull-right">
        <a href="{{ $new_url }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Створити</a>
    </div>
@stop