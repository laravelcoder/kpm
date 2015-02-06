@extends('laravel-bootstrap::layouts.interface-edit-multi')

@section('title')
    Доступ до університету: {{ $item->name }}
@stop

@section('heading')
    <h1>Доступ до університету: <small>{{ $item->name }}</small></h1>
@stop

@section('side-menu')
    @if (allowed('universities', 'edit'))<li><a href="{{$edit_url.$item->id}}">Редагування</a></li>@endif
    <li class="active"><a href="#">Доступ</a></li>
@stop

@section('form-items')
    <div class="row">
        @if (allowed('users', 'select'))
        <a href="#" class="pull-right js-modal-select btn btn-success" data-url="{{URL::action('Davzie\LaravelBootstrap\Controllers\UsersController@getSelect', array($item->id))}}/?window"><i class="glyphicon glyphicon-plus"></i> Додати</a>
        @endif
    </div>
    <div class="list">
        <table class="table table-stripped ">
            <thead>
                <tr>
                    <th>Користувач</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->user->first_name}} {{$user->user->last_name}}</td>
                        <td>
                            @if (allowed('universities', 'removeUser'))
                            <a href="#" class="btn btn-sm btn-default js-remove-from-list" data-url="{{$object_url . '/remove-user/' . $item->id}}" data-id="{{$user->user_id}}">Видалити зі списку</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                @if ($users->isEmpty())
                    <tr>
                        <td colspan="2">
                            <div class="alert alert-info">
                                <strong>Список порожній</strong>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@stop
