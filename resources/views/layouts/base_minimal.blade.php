<!DOCTYPE html>
<html lang="en">
<head>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!--    <meta name="viewport" content="width=device-width"/>-->
    <meta charset="UTF-8"/>

    <meta name="author" content="duncte123"/>
    <meta name="application-name" content="DuncteBot"/>
    <meta name="keywords" content="discord, bot, music, youtube, google, best discord bot, spotify, rythm"/>
    <meta name="description" content="{!! $description !!}"/>
    <meta content="DuncteBot" property="og:site_name"/>
    <meta content="@yield('title')" property="og:title"/>
    <meta content="website" property="og:type"/>
    <meta content="{!! $description !!}" property="og:description"/>
    <meta name="theme-color" content="{!! $color !!}"/>
    <meta name="msapplication-TileColor" content="{!! $color !!}"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@DuncteBot"/>
    <meta name="twitter:title" content="@yield('title')"/>
    <meta name="twitter:description" content="{!! $description !!}"/>
    <meta name="twitter:image" content="/img/favicon.png"/>

    <meta content="/img/favicon.png" property="og:image"/>
    <link href="/img/favicon.png" rel="icon" type="image/png"/>
    <link href="/img/favicon.png" rel="shortcut icon" type="image/png"/>
    <link href="/img/favicon.png" rel="apple-touch-icon" type="image/png"/>

    <style>
        * {
            --color: {!! $color !!};
        }
    </style>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="/css/materialize.custom.css?time={!! $timestamp !!}"/>
    <link rel="stylesheet" href="/css/style.css?time={!! $timestamp !!}"/>
    <link rel="stylesheet" href="/css/animate.css?time={!! $timestamp !!}"/>

    <title>@yield('title')</title>
</head>
<body class="discord body">

<main>
    <div class="container">
        @yield('content')
    </div>
</main>

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
{{--<script async src="https://www.googletagmanager.com/gtag/js?id=UA-114140362-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-114140362-3');
</script>--}}
<!-- Cloudflare Web Analytics -->
<script async defer src='https://static.cloudflareinsights.com/beacon.min.js' data-cf-beacon='{"token": "25f915de0b044c90a1fe610906b1ca19", "spa": false}'></script>
<!-- End Cloudflare Web Analytics -->
<!-- Cloudflare Web Analytics -->
<script defer src='https://static.cloudflareinsights.com/beacon.min.js' data-cf-beacon='{"token": "085d795bab7548109bb66dd76d87371a", "spa": false}'></script>
<!-- End Cloudflare Web Analytics -->

@stack('scripts')
</body>
</html>
