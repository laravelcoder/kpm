<div class="header1">
	<div>
		<div id='cssmenu' class="align-center">
			<div id="menu-button">
				<div class="left-logo"><img src="/public/images/logo_small.png"><a href="{{action('HomeController@index')}}">{{_('Кафедра прикладної математики та інформатики')}}</a></div>
			</div>
			<span class="search-bar-tip"><a href="#" class="js-dd-panel" data-target=".search-block"><i class="fa fa-chevron-down"></i></a></span>
			<div class="search-block">
				<div class="lang-select">
					@foreach ($lang_urls as $code => $url)
						<a href="{{$url}}" @if ($code == App::getLocale()) class="active" @endif >{{Str::upper($code)}}</a>
					@endforeach
				</div>
				<div class="search search-field ggl">
				   <script>
  (function() {
    var cx = '010614732354364382195:ss3m2udjts4';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:searchbox-only></gcse:searchbox-only>
				</div>
			</div>
			@include('partials.menu', ['items' => $menu])
		</div>
	</div>
</div>
@section('header.logo')
	<div class="contact">
		<div class="wrap">
			<div class="header_top">
			</div>
		</div>
	</div>
@show