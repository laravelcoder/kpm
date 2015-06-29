<div class="content_bottom">
	<div class="container">
		<h3></h3>
	</div>
</div>
<div class="footer">
	<div class="container">
		<div class="">
			<ul class="list_1">
				<li><a href="{{action('AdvertsController@getIndex')}}">{{_('Оголошення')}}</a></li>
				<li><a href="{{action('PagesController@getLinks')}}">{{_('Корисні посилання')}}</a></li>
				<li><a href="{{action('PagesController@getContact')}}">{{_('Контакти')}}</a></li>
				<li><a href="http://studvel.com">{{_('Studvel')}}</a></li>
				<li><a href="/moodle">{{_('Moodle')}}</a></li>
				<li><a href="{{action('PagesController@getRss')}}">{{_('RSS')}}</a></li>
			</ul>
		</div>
		<div class="list_2 center">
		  <p>@if (isset($settings['phone']))
		  		{{$settings['phone']}}
		  	@endif</p>
		  <p><span>
		  	@if (isset($settings['email']))
		  		<a href="mailto:{{$settings['email']}}">{{$settings['email']}}</a>
		  	@endif
		  </span></p>
		  <?php $adress_key = 'address_' . App::getLocale();  ?>
		  <p>@if (isset($settings[$adress_key]))
		  		{{$settings[$adress_key]}}
		  	@endif
		  	</p>
		</div>
		<div class="clearfix"> </div>
		<div class="copy">
			<p>© 2015 {{_('Кафедра прикладної математики та інформатики')}} </p>
		</div>
	</div>
	<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
</div>