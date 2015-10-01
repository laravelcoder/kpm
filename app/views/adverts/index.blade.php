@extends('base')

@section('title'){{_('Оголошення')}}@stop
@section('description'){{_('Оголошення кафедри прикладної математики')}}@stop

@section('content')
	<div class="single">
		<div class="container">
			<div class="col-md-12">
				<div class="grid_1">
					<h4>{{_('Оголошення')}}</h4>
					@if (Input::get('s', false))
						<h5 style="color:#0ec8cb; font-size: 1em;">{{_('Пошук за запитом')}}: <b>"{{Input::get('s')}}"</b></h5>
					@endif
				</div>
			</div>
			<div class="grid_2 text-center">
				@foreach ($items as $item)
					<div class="col-md-3 box_3"><a href="{{action('AdvertsController@getView', array($item->id))}}">
						@if (!empty($item->thumbs))
					    	<img src="{{$item->thumbs['300x200']}}" width="283" class="img-responsive mh220" alt=""/>
					    @endif
					    <div class="blog_desc">
					       <h3>{{$item->title}}</h3>
					       	<p>{{Str::limit($item->descr, 120)}}</p>
					   </div>
					</a></div>
				@endforeach
				@if ($items->isEmpty())
					<h4>{{_('Список порожній')}}</h4>
				@endif
			</div>
		</div>
	</div>
@stop