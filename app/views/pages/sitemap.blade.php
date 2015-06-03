@extends('base')

@section('title') {{_('Карта сайту')}} @stop

@section('content')
	<div class="single">
		<div class="container">
			  <div class="col-md-9">
				<div class="grid_1 left">
					<h4 class="top-header">{{_('Карта сайту')}}</h4>
					<ul class="list_1 sitemap">
						<li><a href="{{action('HomeController@index')}}">{{_('Голова сторінка')}}</a></li>
						<li><a href="{{action('NewsController@getIndex')}}">{{_('Новини')}}</a></li>
						<li><a href="{{action('TeachersController@getIndex')}}">{{_('Викладачі')}}</a></li>
						<li><a href="{{action('PagesController@getGroupSchedule')}}">{{_('Розклад для студентів')}}</a></li>
						<li><a href="{{action('PagesController@getTeacherSchedule')}}">{{_('Розклад для викладачів')}}</a></li>
						@foreach ($pages as $item)
							<li><a href="{{action('PagesController@getView', array($item->slug))}}">{{$item->title}}</a></li>
							@if ($item->sub)
								@include('partials.pages-list', ['items' => $item->sub])
							@endif
						@endforeach
						<li><a href="{{action('PagesController@getContact')}}">{{_('Контакти')}}</a></li>
						<li><a href="{{action('PagesController@getSitemap')}}">{{_('Карта сайту')}}</a></li>
						<li><a href="{{action('PagesController@getRss')}}">{{_('RSS')}}</a></li>
					</ul>
				</div>
			 </div>
			 <div class="col-md-3 sidebar">
				{{View::make('widgets.teachers')}}
				{{View::make('widgets.last-posts')}}
		     </div>
		     <div class="clearfix"> </div>
		 </div>
	</div>
@stop