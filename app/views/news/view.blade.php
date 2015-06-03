@extends('base')

@section('title') {{$item->title}} @stop

@section('content')
	<div class="single">
		<div class="container">
			  <div class="col-md-9">
				  <div class="blog_left">
					<h2>{{$item->title}}</h2>
				    <h3><i class="fa fa-calendar"></i> {{$item->time_publish}} &nbsp; <i class="fa fa-eye"></i> {{$item->views->count()}} &nbsp;</h3>
				    {{-- add img --}}
				    <img src="{{$item->thumbs['o']}}" class="img-responsive" alt="{{$item->title}}">
				    {{$item->body}}
			       </div>
			 </div>
			 <div class="col-md-3 sidebar">
					{{-- search widget --}}
					@include('widgets.search', ['url' => action('NewsController@getIndex'), 'title' => _('Пошук по новинах')])
					 {{-- rubrics widget --}}
					 {{View::make('widgets.rubrics')}}
					 {{-- latest news --}}
					 {{View::make('widgets.last-posts')}}
		     </div>
		     <div class="clearfix"> </div>
		 </div>

	</div>
@stop