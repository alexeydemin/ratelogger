<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ trans('messages.title') }}</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <link rel="stylesheet" href="/css/app.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
<div id="ratelogger">
    @yield('content')
</div>
    @yield('footer')
</body>
</html>
