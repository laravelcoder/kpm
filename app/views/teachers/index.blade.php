@extends('base')

@section('title') {{_('Викладачі')}} @stop

@section('content')
	<div class="single">
		<div class="container">
			<div class="col-md-12">
				<div class="grid_1">
					<h4>{{_('Викладачі')}}</h4>
					@if (Input::get('s', false))
						<h5 style="color:#0ec8cb; font-size: 1em;">{{_('Пошук за запитом')}}: <b>"{{Input::get('s')}}"</b></h5>
					@endif
				</div>
				<div class="grid_2 text-center">
					@foreach ($items as $item)
						<div class="col-md-4 teacher-item">
							<a href="{{action('TeachersController@getView', array($item->id))}}">
							    <img src="{{$item->thumbs['283x189']}}" width="150" height="150" class="img-responsive" alt=""/>
							    <h3>{{$item->surname}} {{$item->name}} {{$item->second_name}}</h3>
							    <p class="text-muted">{{$item->status}}</p>
							</a>
						</div>
					@endforeach
					@if ($items->isEmpty())
						<h4>{{_('Список порожній')}}</h4>
					@endif
				</div>
			</div>
		    <div class="clearfix"> </div>
		</div>
	</div>
@stop