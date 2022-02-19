<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title'){{Helpers::setting( 'site.title' )}}</title>
    <meta name="title" content="@yield('title') {{Helpers::setting( 'site.title' )}}" />
    <meta name="keywords" content="@yield('keywords'){{Helpers::setting( 'site.anahtarkelime' )}}">
    <meta property="og:title" content="@yield('title') {{Helpers::setting( 'site.title' )}}" />
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
    <meta name="copyright" content="(c) {{date('Y')}}" />
    <meta http-equiv="content-language" content="tr" />
    @include('frontend.include.css')


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    {!! Helpers::setting( 'site.googleKey' ) !!}
</head>

<body>

    <div class="preloader">
        <div class="loader"></div>
        <h6 class="preloader-text">Uzm.Dr. Semra<br>Yavuz</h6>
    </div>

    <div class="page">

        @include('frontend.include.header_top')
        @include('frontend.include.header')



        @yield('content')

        @include('frontend.include.footer')
    </div>

    <div class="to-top" id="scrollUp"><i class="fa fa-angle-up"></i></div>


    <div class="popup-form">
        <div class="inner-block">
            <span class="popup-form-close" id="popup-form-close">&times;</span>
            <div class="img">
                <img src="/frontend/images/jpg/popup-form.jpg">
            </div>
            <form action="{{ route('randevuolustur') }}" method="POST">
                @csrf
                @method('post')
                <input type="hidden" name="formPath" value="Randevu">
                <h1 class="section-title">Randevu Talebi Oluşturun</h1>
                <div class="input-box">
                    <label for="popup-name">Adınız *</label>
                    <input type="text" name="data[][Adı]" id="popup-name" required>
                </div>
                <div class="input-box">
                    <label for="popup-name">Soyadınız *</label>
                    <input type="text" name="data[][Soyadı]" id="popup-name" required>
                </div>

                <div class="input-box">
                    <label for="popup-email">E-Posta Adresiniz *</label>
                    <input type="text" name="data[][Email]" id="popup-email" required>
                </div>

                <div class="input-box">
                    <label for="popup-phone">Telefon *</label>
                    <input name="data[][Telefon]" type="tel" id="popup-phone" required>
                </div>
                <button type="submit" class="btn btn-2_pink">Randevu Al</button>
            </form>
        </div>
    </div>
    @include('frontend.include.script')
</body>

</html>
