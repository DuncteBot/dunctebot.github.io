<!DOCTYPE html>
<html lang="en">
<head>
    <!--Let browser know website is optimized for mobile-->
    <!--    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>-->
    <meta name="viewport" content="width=device-width"/>
    <meta charset="UTF-8"/>

    <meta name="author" content="duncte123"/>
    <meta name="application-name" content="DuncteBot"/>
    <meta name="keywords" content="discord, bot, music, youtube, google, best discord bot, spotify, rythm"/>
    <meta name="description" content="{!! $description !!}"/>
    <meta property="og:site_name" content="DuncteBot"/>
    <meta property="og:title" content="@yield('title')"/>
    <meta property="og:type" content="website"/>
    <meta property="og:description" content="{!! $description !!}"/>
    <meta name="theme-color" content="{!! $color !!}"/>
    <meta name="msapplication-TileColor" content="{!! $color !!}"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@DuncteBot"/>
    <meta name="twitter:title" content="@yield('title')"/>
    <meta name="twitter:description" content="{!! $description !!}"/>
    <meta name="twitter:image" content="/img/favicon.png"/>

    <meta property="og:image" content="/img/favicon.png"/>
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
    @stack('styles')

    <title>@yield('title')</title>
</head>
<body class="discord body">
<header>

    <div class="navbar-fixed">
        <nav class="indigo">
            <div class="container">
                <div class="nav-wrapper">
                    <a href="/" class="brand-logo">DuncteBot</a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li @checkActiveClass('Home') ><a href="/">Home</a></li>
                        <li @checkActiveClass('List of commands') ><a href="/commands">Commands</a></li>
                        <li @checkActiveClass('Leave a suggestion') ><a href="/suggest">Suggest</a></li>
                        <li @checkActiveClass('Donate to DuncteBot') ><a href="/donate">Donators</a></li>
                        <li><a href="{!! $dashboardDomain !!}">Dashboard</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <ul class="sidenav discord dark-not-black" id="mobile-demo">
        <li @checkActiveClass('Home') ><a class="discord-text text-full-white" href="/">Home</a></li>
        <li @checkActiveClass('List of commands') ><a class="discord-text text-full-white" href="/commands">Commands</a></li>
        <li @checkActiveClass('Leave a suggestion') ><a class="discord-text text-full-white" href="/suggest">Suggest</a></li>
        <li @checkActiveClass('Donate to DuncteBot') ><a class="discord-text text-full-white" href="/donate">Donators</a></li>
        <li><a class="discord-text text-full-white" href="{!! $dashboardDomain !!}">Dashboard</a></li>
    </ul>
</header>

<main>
    <div class="container">
        @yield('content')
    </div>
</main>

<footer class="page-footer indigo">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">DuncteBot</h5>
                <p class="grey-text text-lighten-4">A fast multipurpose discord bot that plays music from Spotify</p>
                <a href="https://twitter.com/DuncteBot?ref_src=twsrc%5Etfw" class="twitter-follow-button"
                   data-show-count="true">Follow @DuncteBot</a>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="{!! $botInvite !!}" target="_blank">Invite bot</a></li>
                    <li><a class="grey-text text-lighten-3" href="{!! $guildInvite !!}" target="_blank">Join server</a></li>
                    <li><a class="grey-text text-lighten-3" href="/privacy">Privacy Policy</a></li>
                    <li><a class="grey-text text-lighten-3" href="https://paypal.me/duncte123"
                           target="_blank">Donate</a></li>
                    <li><a class="grey-text text-lighten-3" href="https://github.com/DuncteBot/dunctebot.github.io"
                           target="_blank">Github</a></li>
                    <li>
                        <p>
                            <a href="https://www.patreon.com/bePatron?u=6419542" data-patreon-widget-type="become-patron-button">Become a Patron!</a>
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright indigo darken-3">
        <div class="container">
            &copy; 2017-{!! date('Y') !!} DuncteBot Team
            <small class="right">
                This site is protected by hCaptcha and its
                <a href="https://hcaptcha.com/privacy" target="_blank">Privacy Policy</a> and
                <a href="https://hcaptcha.com/terms" target="_blank">Terms of Service</a> apply.
            </small>
        </div>
    </div>
</footer>
<script async src="https://c6.patreon.com/becomePatronButton.bundle.js"></script>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
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

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js" crossorigin="anonymous"></script>
<script src="/js/main.js?time={!! $timestamp !!}"></script>
@stack('scripts')
<!--<script data-ad-client="ca-pub-6855340104827815" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>-->
</body>
</html>
