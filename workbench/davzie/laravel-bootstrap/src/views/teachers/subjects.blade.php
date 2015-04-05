@extends('laravel-bootstrap::layouts.interface-edit-multi')

@section('title')
    Предмети викладача: {{ $item->name }} {{ $item->surname }}
@stop

@section('breadcrumbs')
    <li><a href="{{route('universities')}}">Університети</a></li>
    <li class="active">{{$item->department->faculty->university->name}}</li>
    <li class=""><a href="{{route('faculties', $item->department->faculty->university->id)}}">Факультети</a></li>
    <li class=""><a href="{{route('departments', $item->department->faculty->id)}}">Кафедри</a></li>
    <li class=""><a href="{{route('teachers', $item->department->id)}}">Список викладачів</a></li>
    <li class="active">Предмети викладача</li>
@stop

@section('heading')
    <h1>Предмети викладача: <small>{{ $item->name }} {{ $item->surname }}</small></h1>
@stop

@section('side-menu')
    @if (allowed('teachers', 'edit'))<li><a href="{{$edit_url.$item->id}}">Редагування</a></li>@endif
    <li class="active"><a href="#">Предмети</a></li>
@stop

@section('form-items')
    <div class="row">
        @if (allowed('subjects', 'select'))
        <a href="#" class="pull-right js-modal-select btn btn-success" data-url="{{URL::action('Davzie\LaravelBootstrap\Controllers\SubjectsController@getSelect', array($item->id))}}/?window"><i class="glyphicon glyphicon-plus"></i> Додати</a>
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
                @forelse($subjects as $subject)
                    <tr>
                        <td>{{$subject->subject->title}}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-default js-remove-from-list" data-url="{{$object_url . '/remove-subject/' . $item->id}}" data-id="{{$subject->subject_id}}">Видалити зі списку</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">
                            <div class="alert alert-info">
                                <strong>Список порожній</strong>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@stop
