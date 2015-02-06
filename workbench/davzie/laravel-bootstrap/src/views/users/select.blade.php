@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Користувачі
@stop

@section('breadcrumbs')
    <li class="active">Список користувачів</li>
@stop

@section('content')

    <h1>Користувачі</h1>

    {{-- The error / success messaging partial --}}
    @include('laravel-bootstrap::partials.messaging')

    @if( !$items->isEmpty() )
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Імя</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->full_name }}</td>
                        <td><a href="#" class="btn btn-default btn-sm js-select-modal-item" data-id="{{$item->id}}" >Обрати</a></td>
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