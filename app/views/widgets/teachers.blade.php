<div class="blog_list2">
 	<h3>{{_('Викладачі')}}</h3>
 	@foreach ($teachers as $item)
		<ul class="blog-list3">
			<li class="blog-list3-img"><img src="{{$item->thumbs['100x100']}}" class="img-responsive" alt="" style="height: 62px;" /></li>
			<li class="blog-list3-desc">
			   <h4><a href="{{action('TeachersController@getView', array($item->id))}}">{{$item->surname}} {{$item->name}} {{$item->second_name}}</a></h4>
			  <p>{{$item->status}}</p>
			</li>
			<div class="clearfix"> </div>
		</ul>
	@endforeach
</div>