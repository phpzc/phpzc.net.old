<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />

    <title>Page 404</title>
    <link rel="stylesheet" href="{{ tabler_assets('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ tabler_assets('css/googleapis-css-family.css') }}">
    <script src="{{ tabler_assets('js/require.min.js') }}"></script>
    <script>
        requirejs.config({
            baseUrl: '/Public/tabler'
        });
    </script>

    <!-- Dashboard Core -->
    <link href="{{ tabler_assets('css/dashboard.css') }}" rel="stylesheet" />
    <script src="{{ tabler_assets('js/dashboard.js') }}"></script>

    <script src="{{ CUBE('js/jquery.js') }}"></script>
</head>
<body class="">
<div class="page">
    <div class="page-content">
        <div class="container text-center">
            <div class="display-1 text-muted mb-5"><i class="si si-exclamation"></i> 404</div>
            <h1 class="h2 mb-3">Oops.. You just found an error page..</h1>
            <p class="h4 text-muted font-weight-normal mb-7">We are sorry but our service is currently not available&hellip;</p>

            <a class="btn btn-primary" href="/" id="target_url" >
                <i class="fe fe-arrow-left mr-2"></i>Go back
            </a>
        </div>
    </div>
</div>
</body>
</html>