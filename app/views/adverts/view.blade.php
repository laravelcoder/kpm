@extends('base')

@section('title'){{$item->title}} &mdash; {{_('Оголошення')}}@stop
@section('description'){{Str::limit(strip_tags($item->descr), 200) }}@stop
@section('og_image'){{$item->thumbs['170x170']}}@stop

@section('content')
	<style>
		.blog_left h3 a:not(:last-child)::after {
			content: ',';
		}

		.blog_left .news-img {
			margin: 15px 0px;
			display: inline-block;
		}
	</style>
	<div class="single">
		<div class="container">
			  <div class="col-md-9">
				  <div class="blog_left">
					<h2 style="margin-bottom: 0.8em;">{{$item->title}}</h2>
				    {{-- add img --}}
				    <div style="text-align: center;">
				    @if (file_exists($item->thumbs['o']))
					    <img src="{{$item->thumbs['o']}}" class="img-responsive news-img" alt="{{$item->title}}">
					@endif
				    </div>
				    {{$item->body}}
				    @include('partials.social')
			       </div>
			 </div>
			 <div class="col-md-3 sidebar">
					{{-- search widget --}}
					@include('widgets.search', ['url' => action('AdvertsController@getIndex'), 'title' => _('Пошук по оголошеннях')])
					 {{-- rubrics widget --}}
					 {{View::make('widgets.adverts')}}
					 {{-- latest news --}}
					 {{View::make('widgets.last-posts')}}
		     </div>
		     <div class="clearfix"> </div>
		 </div>

	</div>
@stop