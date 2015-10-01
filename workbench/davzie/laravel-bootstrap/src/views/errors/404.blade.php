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

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <title>404: Сторінку не знайдено</title>
</head>

<body class="">

    <div class="container" style="text-align:center;">
        <h1 style="font-size: 125px;">404</h1>
        <h2>Сторінку не знайдено</h2>
    </div>

    @section('scripts')
        <script src="{{ asset('public/packages/davzie/laravel-bootstrap/js/jquery.js') }}"></script>
        <script src="{{ asset('public/packages/davzie/laravel-bootstrap/js/bootstrap.min.js') }}"></script>
    @show
</body>
</html>
