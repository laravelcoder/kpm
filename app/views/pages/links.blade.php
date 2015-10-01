@extends('base')

@section('title'){{_('Корисні посилання')}}@stop

@section('content')
	<div class="single">
		<div class="container">
			<div class="col-md-12">
				<div class="grid_1">
					<h4>{{_('Корисні посилання')}}</h4>
				</div>
			</div>
			<div class="grid_2 text-center links">
		   		@foreach ($links as $link)
					<div class="col-md-3 box_3"><a href="{{$link->link}}">
					    <div class="blog_desc">
					       <h3 style="margin-bottom: 0px;">{{$link->title}}</h3>
					   </div>
					</a></div>
				@endforeach
				@if ($links->isEmpty())
					<h4>{{_('Список порожній')}}</h4>
				@endif
				<div class="clearfix"> </div>
		   </div>
		</div>
	</div>
@stop