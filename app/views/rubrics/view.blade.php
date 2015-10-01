@extends('base')

@section('title'){{$rubric->title}} &mdash; {{_('Новини')}}@stop

@section('content')
	<div class="single">
		<div class="container">
			<div class="col-md-12">
				<div class="grid_1">
					<h4 style="font-size: 2.3em;">{{_('Новини рубрики')}} "{{$rubric->title}}"</h4>
					@if (Input::get('s', false))
						<h5 style="color:#0ec8cb; font-size: 1em;">{{_('Пошук за запитом')}}: <b>"{{Input::get('s')}}"</b></h5>
					@endif
				</div>
			</div>
			<div class="grid_2 text-center">
				@foreach ($rubric->news as $item)
					<div class="col-md-3 box_3"><a href="{{action('NewsController@getView', array($item->slug))}}">
						@if (!empty($item->thumbs))
					    	<img src="{{$item->thumbs['283x189']}}" width="283" class="img-responsive" alt=""/>
					    @endif
					    <div class="blog_desc">
					       <h3>{{$item->title}}</h3>
					       	<p>{{Str::limit($item->descr, 120)}}</p>
					       <div class="date_desc">
					          <div class="date_desc-left"><h4>{{$item->time_publish}}</h4></div>
					          <div class="date_desc-right"><img src="/public/images/arrow1.png" alt=""/></div>
					          <div class="clearfix"> </div>
					       </div>
					   </div>
					</a></div>
				@endforeach
				@if ($rubric->news->isEmpty())
					<h4>{{_('Список порожній')}}</h4>
				@endif
			</div>
		</div>
	</div>
@stop