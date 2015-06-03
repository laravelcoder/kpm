<ul>
	@foreach ($items as $item)
		<li><a href="{{action('PagesController@getView', array($item->slug))}}">{{$item->title}}</a></li>
		@if ($item->sub)
			@include('partials.pages-list', ['items' => $item->sub])
		@endif
	@endforeach
</ul>