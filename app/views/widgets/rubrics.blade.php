<ul class="blog-list">
	<h3>{{_('Рубрики')}}</h3>
	@foreach ($rubrics as $item)
		<li><a href="{{action('RubricsController@getView', array($item->slug))}}">{{$item->title}}</a></li>
	@endforeach
</ul>