<html>
<head>
    <title>Title - @yield('title')</title>
</head>
<body>
@section('sidebar')
    Left Bar
@show

<div class="container">
    @yield('content')
</div>
</body>
</html>