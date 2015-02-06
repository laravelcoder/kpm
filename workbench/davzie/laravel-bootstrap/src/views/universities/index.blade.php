@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Список університетів
@stop

@section('breadcrumbs')
    <li class="active">Університети</li>
@stop

@section('content')

    <h1>Університети</h1>
    <p>Список доступних університетів</p>

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
                        <td><a href="{{$edit_url.$item->university->id}}">{{$item->university->id}}</a></td>
                        <td><a href="{{$edit_url.$item->university->id}}">{{$item->university->name}}</a>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Опції <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    @if (allowed('universities', 'edit'))
                                    <li><a href="{{$edit_url.$item->university->id}}">
                                    <i class="glyphicon glyphicon-edit"></i> Редагувати</a></li>
                                    @endif
                                    @if (allowed('universities', 'delete'))
                                    <li><a href="{{$delete_url.$item->university->id.'/?token='.Hash::make('delete')}}"><i class="glyphicon glyphicon-trash"></i> Видалити</a></li>
                                    @endif
                                    <li class="divider"></li>
                                    @if (allowed('faculties', 'index'))
                                    <li><a href="{{URL::action('Davzie\LaravelBootstrap\Controllers\FacultiesController@getIndex', array($item->university->id))}}">
                                    <i class="glyphicon glyphicon-list"></i> Факультети</a></li>
                                    @endif
                                    @if (allowed('subjects', 'index'))
                                    <li><a href="{{route('subjects', array($item->university->id))}}">Предмети</a></li>
                                    @endif
                                     @if (allowed('bellsSchedule', 'index'))
                                    <li><a href="{{route('bellsSchedule', array($item->university->id))}}">Розклад дзвінків</a></li>
                                    @endif
                                    @if (allowed('weeks', 'index'))
                                    <li><a href="{{route('weeks', array($item->university->id))}}">Тижні навчання</a></li>
                                    @endif
                                    @if (allowed('buildings', 'index'))
                                    <li><a href="{{route('buildings', array($item->university->id))}}">Навчальні корпуси</a></li>
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
        {{--$items->links()--}}
    </div>
    <div class="pull-right">
         @if (allowed('universities', 'new'))
        <a href="{{$new_url}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Додати</a>
        @endif
    </div>
@stop
