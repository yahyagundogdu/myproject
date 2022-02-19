<!DOCTYPE html>
<html lang="tr">

<head>
    <title>@yield('title'){{ Helpers::setting('site.title') }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="@yield('title') {{ Helpers::setting('site.title') }}" />
    <meta name="keywords" content="@yield('keywords'){{ Helpers::setting('site.anahtarkelime') }}">
    <meta property="og:title" content="@yield('title') {{ Helpers::setting('site.title') }}" />
    <meta property="og:description" content="@yield('description')" />
    <link rel="icon" href="{{ Storage::url(Helpers::setting('site.favicon')) }}">
    <link rel="shortcut icon" href="{{ Storage::url(Helpers::setting('site.favicon')) }}" />

    <meta name="application-name" content="{{ Helpers::setting('site.title') }}" />
    <meta name="googlebot" content="all" />
    <meta name="revisit-after" content="1 Days" />
    <meta name="distribution" content="global" />
    <meta name="rating" content="general" />
    <meta name="author" content="Uzm.Dr.Semra Yavuz" />
    <meta http-equiv="copyright" content="Uzm.Dr.Semra Yavuz" />
    <meta name="copyright" content="(c) {{ date('Y') }}" />
    <meta http-equiv="content-language" content="tr" />

    @include('frontend.include.css')

    {!! Helpers::setting('site.googleKey') !!}

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600&amp;subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="page-loader"></div>

    <div class="wrapper">

        @include('frontend.include.header')

        @yield('content')

        @include('frontend.include.footer')

    </div>
    @include('frontend.include.script')
</body>

</html>
