<div class="blog_list2">
 	<h3>{{_('Останні новини')}}</h3>
 	@foreach ($latest_news as $item)
		<ul class="blog-list3">
			<li class="blog-list3-img"><img src="{{$item->thumbs['100x100']}}" class="img-responsive" alt="" style="height: 62px;" /></li>
			<li class="blog-list3-desc">
			   <h4><a href="{{action('NewsController@getView', array($item->slug))}}">{{$item->title}}</a></h4>
			  <p>{{$item->time_publish}}</p>
			</li>
			<div class="clearfix"> </div>
		</ul>
	@endforeach
</div>