@extends('base')

@section('title') {{_('Головна сторінка')}} &mdash;  {{_('Інформація про кафедру, новини, опитування, викладачі')}} @stop

@section('header.logo')
	<div class="header">
		<div class="wrap">
		   <div class="header_top">
		         <div class="logo">
			     	<h2>hello, world ;)</h2>
			     </div>
			     <div class="header_arrow">
		          <a href="#arrow" class="scroll"><span> </span></a>
		        </div>
		   </div>
		</div>
	</div>
@stop

@section('content')
	<div class="content_top" id="arrow">
		<div class="container">
		   <div class="grid_1">
		   	 <!-- <h3>Our Recent Posts</h3> -->
		   	 <h4>{{_('Новини')}}</h4>
		   	 <!-- <p>We do not build websites but user experiences. We judge our performance according to the impact it makes</p> -->
		   </div>
		   <div class="grid_2 text-center">
		   		@foreach ($news as $item)
					<div class="col-md-3 box_3"><a href="{{action('NewsController@getView', array($item->slug))}}">
					    <img src="{{$item->thumbs['283x189']}}" width="283" class="img-responsive" alt=""/>
					    <div class="blog_desc">
					       <h3>{{{$item->title}}}</h3>
					       <p>{{{Str::limit($item->descr, 120)}}}</p>
					       <div class="date_desc">
					          <div class="date_desc-left"><h4>{{$item->time_publish}}</h4></div>
					          <div class="date_desc-right"><img src="/public/images/arrow1.png" alt=""/></div>
					          <div class="clearfix"> </div>
					       </div>
					   </div>
					</a></div>
				@endforeach
				<div class="clearfix"> </div>
		   </div>
		</div>
	</div>
	<div class="content_top" id="works">
		<div class="container">
			<div class="grid_1">
				<h3></h3>
				<h2>{{_('Корисні посилання')}}</h2>
				<p></p>
		   </div>
		   <div class="grid_2 text-center links">
		   		@foreach ($links as $link)
					<div class="col-md-3 box_3"><a href="{{$link->link}}">
					    <div class="blog_desc">
					       <h3>{{$link->title}}</h3>
					   </div>
					</a></div>
				@endforeach
				<div class="clearfix"> </div>
		   </div>
		</div>
	</div>
	<div class="content_top" id="arrow">
		<div class="container">
		   <div class="grid_1">
		   	 <!-- <h3>Our Recent Posts</h3> -->
		   	 <h4>{{_('Опитування')}}</h4>
		   	 <!-- <p>We do not build websites but user experiences. We judge our performance according to the impact it makes</p> -->
		   </div>
		   <div class="grid_2 text-center">
		   		@foreach ($polls as $poll)
					<div class="col-md-3 box_3 polls-c">
					    <div class="blog_desc">
					       <h3>{{$poll->title}}</h3>
					       @if (!$poll->voted())
						       <div class="poll">
						       		@foreach ($poll->answers as $answer)
						       			<div><label><input type="radio" name="n1"> <span class="">{{$answer->title}}</span></label></div>
						       		@endforeach
						       </div>
						    @endif
					       <div class="poll-result @if (!$poll->voted()) hide @endif">
					       		@foreach ($poll->answers as $answer)
						       		<div class="vote-item">
						       			<div class="text-muted">{{$answer->title}}</div>
						       			<div class="vote-result-value" style="width: {{$answer->votes->count()}}%;">{{$answer->votes->count()}}%</div>
						       		</div>
						       	@endforeach
					       </div>
					        @if (!$poll->voted())
						       <div class="poll-control">
									<button class="btn btn-default" type="submit">{{_('Голосувати')}}</button>
									<a href="#" class="js-toggle-poll" data-text="{{_('Опитування')}}">{{_('Результати')}}</a>
								</div>
							@endif
					   </div>
					</div>
				@endforeach

				<div class="clearfix"> </div>
		   </div>
		</div>
	</div>
@stop
