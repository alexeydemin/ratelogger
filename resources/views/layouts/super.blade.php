<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to TinkoffParser</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
</head>
<body>

<div class="container">
  <div class="col-md-9">
    @yield('content')
  </div>

  <div class="col-md-3">
      @section('advertisement')
      <p>
          Jamz and Sun Lotion Special $29!
      </p>
      @show
  </div>
</div>


</body>

</html>