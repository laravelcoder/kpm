<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>@yield('title')</title>

		<!-- Bootstrap core CSS -->
		@section('css')
			<link rel="stylesheet" href="{{ asset('public/packages/davzie/laravel-bootstrap/css/bootstrap.min.css') }}">
			<link rel="stylesheet" href="{{ asset('public/packages/davzie/laravel-bootstrap/css/styles.css') }}">
			<link rel="stylesheet" href="{{ asset('public/packages/davzie/laravel-bootstrap/css/jquery.tagsinput.min.css') }}">
			<link rel="stylesheet" href="{{ asset('public/packages/davzie/laravel-bootstrap/css/redactor.css') }}">
			<link rel="stylesheet" href="{{ asset('public/packages/davzie/laravel-bootstrap/css/select2.css') }}">
			<link href="//rawgit.com/Eonasdan/bootstrap-datetimepicker/master/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
			<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
		@show

		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

	</head>

	<body @if (!isset($_GET['window'])) class="interface" @endif>
			@if (!isset($_GET['window']))
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">

				<div class="navbar-header">

					{{-- The Responsive Menu Button --}}
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					{{-- The CMS Home Button --}}
					<a class="navbar-brand" href="{{ url( $urlSegment ) }}">{{ $app_name }}</a>
				</div>

				{{-- The menu items at the top (collapses down when browser gets small) --}}
				<div class="collapse navbar-left navbar-collapse">
					@if($menu_items)
						<ul class="nav navbar-nav">
							@foreach($menu_items as $url=>$item)
								@if( $item['top'] && allowed($item['module'], 'index'))
									<li class="{{ Request::is( "$urlSegment/$url*" ) ? 'active' : '' }}">
										<a href="{{ url( $urlSegment.'/'.$url ) }}">{{ $item['name'] }}</a>
									</li>
								@endif
							@endforeach
						</ul>
					@endif
				</div><!-- /.nav-collapse -->
				<div class="collapse navbar-right navbar-collapse">
					<ul></ul>
					<div class="btn-group">
                        <button class="btn btn-danger btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> {{$user->first_name}} <span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                        	<li><a href="{{ url( $urlSegment.'/users/profile/' ) }}"><i class="icon icon-user"></i> Редагування профілю</a></li>
                        	<li class="divider"></li>
                        	<li><a href="{{ url( $urlSegment.'/logout' ) }}">Вихід</a></li>
                        </ul>
                    </div>
				</div>


			</div><!-- /.container -->

		</div><!-- /.navbar -->
			@endif

		<div class="container">
			<div class="row">

			@if (!isset($_GET['window']))
				<div class="col-sm-3">

					@if($menu_items)
						<div class="list-group">
							@foreach($menu_items as $url=>$item)
								@if (allowed($item['module'], 'index'))
								<a class="list-group-item {{ Request::is( "$urlSegment/$url/*" ) ? 'active' : '' }}" href="{{ url( $urlSegment.'/'.$url ) }}">
									<span class="icon icon-{{ $item['icon'] }}"></span> {{ $item['name'] }}
								</a>
								@endif
							@endforeach
						</div>
					@endif

				</div>
			@endif
				<div class="col-sm-9">
					@if (!isset($_GET['window']))
					<ul class="breadcrumb">
							<li class="active"><a href="{{ url( $urlSegment ) }}">Home</a></li>
						@section('breadcrumbs')
						@show
					</ul>
					@endif
					@yield('content')
				</div>

			</div>
		</div>

		<div class="container">
			<hr>
			<footer>
				<p>&copy; {{ $app_name }}, {{ date('Y') }}</p>
			</footer>
		</div><!--/.container-->


		@section('scripts')
			<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
			<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>

			<script src="https://select2.github.io/dist/js/select2.full.js"></script>
			<script src="{{ asset('public/packages/davzie/laravel-bootstrap/js/redactor.min.js') }}"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
			<script src="//rawgit.com/Eonasdan/bootstrap-datetimepicker/master/src/js/bootstrap-datetimepicker.js"></script>
			<script src="{{ asset('public/packages/davzie/laravel-bootstrap/js/modal-select.js') }}"></script>
			<script src="{{ asset('public/packages/davzie/laravel-bootstrap/js/selector.js') }}"></script>
			<script src="{{ asset('public/packages/davzie/laravel-bootstrap/js/main.js') }}"></script>
		@show
	</body>
</html>