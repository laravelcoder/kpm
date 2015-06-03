<ul>
	@foreach ($items as $item)
		<li @if ($item->items->count()) class="has-sub" @endif>
			<a href="{{$item->link}}">{{$item->title}}</a>
			@if ($item->items->count())
				@include('partials.menu', ['items' => $item->items])
			@endif
		</li>
	@endforeach
</ul>