@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Зворотній зв`язок
@stop

@section('breadcrumbs')
    <li class="active">Зворотній зв`язок</li>
@stop

@section('content')

    <h1>Зворотній зв`язок</h1>

    {{-- The error / success messaging partial --}}
    @include('laravel-bootstrap::partials.messaging')

    <div class="row">
        <div class="pull-left col-md-2">
            <ul class="nav nav-pills nav-stacked">
                <li @if ($type != 'checked' && $type != 'unchecked') class="active" @endif ><a href="{{action($module.'@getIndex', array('all'))}}">Всі</a></li>
    			<li @if ($type == 'checked') class="active" @endif ><a href="{{action($module.'@getIndex', array('checked'))}}">Переглянуті</a></li>
    			<li @if ($type == 'unchecked') class="active" @endif ><a href="{{action($module.'@getIndex', array('unchecked'))}}">Непереглянуті</a></li>
            </ul>
        </div>
        <div class="col-md-10 left-border">
            @if( !$items->isEmpty() )
		        <table class="table table-condensed">
		            <thead>
		                <tr>
		                    <th>Тема</th>
		                    <th>Від</th>
		                    <th>Email</th>
		                    <th>&nbsp;</th>
		                </tr>
		            </thead>
		            <tbody>
		                @foreach($items as $item)
		                    <tr>
		                        <td>{{$item->subject}}</a></td>
		                        <td>{{$item->from}}</a></td>
		                        <td>{{$item->mail}}</a></td>
		                        <td>
		                            <div class="btn-group">
		                            	@if (allowed('feedback', 'view'))
	                                    	<a href="{{action($module.'@getView', array($item->id))}}" class="btn btn-default btn-xs"><i class="icon {{$item->is_checked ? 'icon-eye-open' : 'icon-eye-closed'}}"></i></a>
	                                    @endif
	                                    @if (allowed('feedback', 'delete'))
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
        </div>
    </div>
@stop
