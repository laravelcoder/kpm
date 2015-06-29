@extends('base')

@section('title'){{$item->title}}@stop
@section('description'){{Str::limit(strip_tags($item->body), 200) }}@stop

@section('content')
		<div class="single">
			<div class="container">
			  <div class="col-md-12">
				  <div class="blog_left">
					<h2>{{$item->title}}</h2>
				    {{$item->body}}
			       </div>
			 </div>
		     <div class="clearfix"> </div>
		 </div>
@stop