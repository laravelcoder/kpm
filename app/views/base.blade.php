<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="">

		<title>@yield('title') &mdash; {{_('Кафедра прикладної математики та інформатки')}}</title>

		<meta name="description" content="@section('description') {{_('Сайт кафедри прикладної математики та інформатики Східноєвропейського національного університету. Про кафедру, новини, оголошення, розклад занять')}} @show">
		<meta name="keywords" content="@section('keywords') {{_('Прикладна математика, інформатика, сайт кафедри, про кафедру, новини кафедри, оголошення, розклад занять, університет, навчання, математичний факультет')}} @show">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<meta property="og:site_name" content="{{_('Кафедра прикладної математики та інформатики СНУ ім. Лесі Українки')}}">
		<meta property="og:locale" content="{{LaravelGettext::getLocale()}}">
		<meta property="og:url" content="{{Request::url()}}">
		<meta property="og:title" content="@yield('title') &mdash; {{_('Кафедра прикладної математики та інформатки')}}" />
		<meta property="og:description" content="@section('description') {{_('Сайт кафедри прикладної математики та інформатики Східноєвропейського національного університету. Про кафедру, новини, оголошення, розклад занять')}} @show" />
		<meta property="og:image" content="@section('og_image'){{url('/public/images/logo_small.png')}}@show" />
		<meta property="og:type" content="@section('og_type') website @show" />
		{{-- CSS block --}}

		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<link href="/public/css/bootstrap.css" rel='stylesheet' type='text/css' />
		<link href="/public/css/font-awesome.min.css" rel='stylesheet' type='text/css' />
		<!-- Custom Theme files -->
		<link href="/public/css/style.css" rel='stylesheet' type='text/css' />
		{{-- <link href="/public/css/gallery.css" rel="stylesheet" type="text/css" media="all" /> --}}
		<link href="/public/css/menu-styles.css" rel="stylesheet" type="text/css" media="all" />
		<link rel="stylesheet" href="/public/css/swipebox.css">
		<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>

	</head>
	<body>
		{{-- include header --}}
		@include('layouts.header')

		{{-- layout section --}}
		@yield('content')

		{{-- include footer --}}
		@include('layouts.footer')

		{{-- include scripts --}}
		<script src="/public/js/jquery-1.11.1.min.js"> </script>
		<script src="/public/js/jquery.swipebox.min.js"></script>
		<script src="/public/js/script.js"></script>
		<script src="/public/js/main.js"></script>
	    <script type="text/javascript">
			jQuery(function($) {
				$(".swipebox").swipebox();
			});
		</script>
		<!------ Eng Light Box ------>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});

				$().UItoTop({ easingType: 'easeOutQuart' });
			});
		</script>
		<script type="text/javascript" src="/public/js/move-top.js"></script>
		<script type="text/javascript" src="/public/js/easing.js"></script>
	</body>
</html>