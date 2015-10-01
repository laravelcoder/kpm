<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('css')
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('public/packages/davzie/laravel-bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/packages/davzie/laravel-bootstrap/css/login.css') }}">
    @show
    <style>
    	input[type=text], input[type=password] {
    		height: 30px;
    	}
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <title>@yield('title')</title>
</head>

<body class="login-form">

    <div class="container">

        <div class="col-xs-2"></div>
        <div class="col-xs-8">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="singin-head center"><i class="icon icon-pencil"></i></span> Відновлення пароля  <a href="/" class="btn btn-danger pull-right"><i class="icon icon-mail-forward"></i></a></h3>
                </div>
                <div class="panel-body">

                    {{ Form::open(array( 'method'=>'POST' , 'class'=>'form-horizontal form-top-margin' , 'role'=>'form' )) }}


                        @include('laravel-bootstrap::partials.messaging')

                        {{-- The first name form item --}}
                        <div class="form-group">
                            {{ Form::label( "email" , 'Email' , array( 'class'=>'col-lg-2 control-label' ) ) }}
                            <div class="col-lg-9">
                                {{ Form::text( "email" , '' , array( 'class'=>'form-control' , 'placeholder'=>'Введіть вашу email-адресу' ) ) }}
                            </div>
                        </div>

						<div class="form-group col-lg-2">
					   		 {{ Form::submit('Підтвердити' , array('class'=>'btn btn-large btn-primary ')) }}
					   	</div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>

    </div>

    @section('scripts')
        <script src="{{ asset('public/packages/davzie/laravel-bootstrap/js/jquery.js') }}"></script>
        <script src="{{ asset('public/packages/davzie/laravel-bootstrap/js/bootstrap.min.js') }}"></script>
    @show
</body>
</html>
