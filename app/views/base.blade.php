<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="">

		<title>@yield('title') &mdash; {{_('Кафедра прикладної математики та інформатки')}}</title>

		<meta name="description" content="@section('description') {{_('Сайт кафедри прикладної математики та інформатики Східноєвропейського національного університету. Про кафедру, новини, оголошення, розклад занять')}} @show">
		<meta name="keywords" content="@section('keywords') {{_('Прикладна математика, інформатика, сайт кафедри, про кафедру, новини кафедри, оголошення, розклад занять, університет, навчання, математичний факультет')}} @show">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<meta property="og:site_name" content="{{_('Кафедра прикладної математики та інформатки СНУ ім. Лесі Українки')}}">
		<meta property="og:locale" content="">
		<meta property="og:url" content="">
		<meta property="og:title" content="@yield('title') &mdash; {{_('Кафедра прикладної математики та інформатки')}}" />
		<meta property="og:description" content="@section('description') {{_('Сайт кафедри прикладної математики та інформатики Східноєвропейського національного університету. Про кафедру, новини, оголошення, розклад занять')}} @show" />
		<meta property="og:image" content="@section('og_image') @show" />
		<meta property="og:type" content="@section('og_type') website @show" />
		{{-- CSS block --}}

	</head>
	<body>
		{{-- include header --}}
		@include('layouts.header')

		{{-- layout section --}}
		@yield('content')

		{{-- include footer --}}
		@include('layouts.footer')

		{{-- include scripts --}}
	</body>
</html>