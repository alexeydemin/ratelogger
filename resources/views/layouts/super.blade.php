<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to TinkoffParser</title>
    <link rel="stylesheet"
          href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <script
        src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script
        src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js">
    </script>
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