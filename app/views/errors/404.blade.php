@extends('base')

@section('title') {{_('Сторінку не знайдено')}} @stop

@section('content')
	<div class="single">
		<div class="container">
			  <div class="col-md-12">
				  <div class="grid_1">
					<h1 class="e404">404</h1>
					<h2>{{_('Сторінку не знайдено')}}</h2>
			       </div>
			 </div>
		     <div class="clearfix"> </div>
		 </div>
	</div>
@stop