@extends('base')

@section('title'){{$item->title}}@stop
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
				    <h3><i class="fa fa-calendar"></i> {{$item->time_publish}} &nbsp;&nbsp; <i class="fa fa-eye"></i> {{$item->views->count()}} &nbsp;&nbsp; <i class="fa fa-tag"></i>
				    	@foreach ($item->rubrics as $rubric)
				    		<a href="{{action('RubricsController@getView', array($rubric->slug))}}" style="color: #C7C7C7;">{{$rubric->title}}</a>
				    	@endforeach
				    </h3>
				    {{-- add img --}}
				    <div style="text-align: center;">
					    <img src="{{$item->thumbs['o']}}" class="img-responsive news-img" alt="{{$item->title}}">
				    </div>
				    {{$item->body}}
				    @include('partials.social')
			       </div>
			 </div>
			 <div class="col-md-3 sidebar">
					{{-- search widget --}}
					@include('widgets.search', ['url' => action('NewsController@getIndex'), 'title' => _('Пошук по новинах')])
					 {{-- rubrics widget --}}
					 {{View::make('widgets.rubrics')}}
					 {{-- latest news --}}
					 {{View::make('widgets.last-posts')}}

					 {{View::make('widgets.adverts')}}
		     </div>
		     <div class="clearfix"> </div>
		 </div>

	</div>
@stop