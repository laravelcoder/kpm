@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Користувачі
@stop

@section('breadcrumbs')
    <li class="active">Список користувачів</li>
@stop

@section('content')

    <div class="pull-right">
        @if (allowed('users', 'new'))
            <a href="{{ $new_url }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Створити</a>
        @endif
    </div>

    <h1>Користувачі</h1>
    {{-- The error / success messaging partial --}}
    @include('laravel-bootstrap::partials.messaging')

    @if( !$items->isEmpty() )
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Імя</th>
                    <th class="options-200">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td><a href="{{ $edit_url.$item->id }}">{{ $item->email }}</a></td>
                        <td><a href="{{ $edit_url.$item->id }}">{{ $item->full_name }}</a></td>
                        <td>
                            <div class="btn-group">
                                @if (allowed('Users', 'edit'))
                                    <a href="{{$edit_url.$item->id}}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-edit"></i></a>
                                @endif
                                @if (allowed('Users', 'delete'))
                                    <a href="{{$delete_url.$item->id}}" class="js-delete btn btn-xs btn-danger" data-message="Видалити?"><i class="glyphicon glyphicon-trash"></i></a>
                                @endif
                                @if (allowed('Users', 'toggle'))
                                    <button type="button" class="js-toggle-bool-value btn btn-xs @if ($item->is_active)btn-success @else btn-default @endif" data-url="{{action($module.'@postToggle', array($item->id))}}" data-column="is_active" data-value="@if ($item->is_active)0 @else 1  @endif">Активний</button>
                                @endif
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
@stop