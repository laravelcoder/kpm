@extends('base')

@section('title'){{$item->surname}} {{$item->name}} {{$item->second_name}} &mdash; {{_('Викладачі')}}@stop
@section('description'){{Str::limit(strip_tags($item->about), 200) }}@stop
@section('og_image'){{$item->thumbs['170x170']}}@stop

@section('content')
	<div class="single">
		<div class="container">
			<div class="col-md-9">
				<div class="blog_left">
					<div style="display:inline-block; width: 100%; margin-bottom: 10px;">
						<img src="{{$item->thumbs['170x170']}}" alt="image" class="img-responsive" style="height: 140px; width: 140px; float:left;margin-right: 20px;">
						<h2 style="margin-top: 0px; margin-bottom: 10px;">{{$item->surname}} {{$item->name}} {{$item->second_name}}</h2>
						<h3>{{$item->status}}</h3>
					</div>
				    {{$item->about}}
			    </div>
			</div>
			<div class="col-md-3 sidebar">
				@include('widgets.search', ['url' => action('TeachersController@getIndex'), 'title' => _('Пошук по викладачах')])
				{{-- add other teachers widget --}}
				{{View::make('widgets.teachers')}}
				{{View::make('widgets.last-posts')}}
		    </div>
		    <div class="clearfix"> </div>
		</div>
	</div>
@stop