<ul class="blog-list">
	<h3>{{_('Рубрики')}}</h3>
	@foreach ($rubrics as $item)
		<li><a href="#">{{$item->title}}</a></li>
	@endforeach
</ul>