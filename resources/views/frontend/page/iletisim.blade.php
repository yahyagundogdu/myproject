@extends('frontend.app')

@if (Session::has('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

@section('title', $page->title . ' - ')
@section('keywords', $page->keywords)
@section('description', $page->description)




@section('content')
    <div class="wrapper">



        <section class="main-header" style="background-image:url(/frontend/assets/images/gallery-2.jpg)">
            <header>
                <div class="container text-center">
                    <h2 class="h2 title">İletişim</h2>
                    <ol class="breadcrumb breadcrumb-inverted">
                        <li><a href="{{route('frontend.index')}}"><span class="icon icon-home"></span></a></li>
                        <li><a class="active" href="contact.html">İletişim</a></li>
                    </ol>
                </div>
            </header>
        </section>

        <section class="contact">

            <!-- === Goolge map === -->

            <div id="map" style="position: relative; overflow: hidden;">
                {!! Helpers::setting('harita_adresi') !!}
            </div>

            <div class="container">

                <div class="row">

                    <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">

                        <div class="contact-block">

                            <div class="contact-info">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <figure class="text-center">
                                            <span class="icon icon-map-marker"></span>
                                            <figcaption>
                                                <strong>Adres</strong>
                                                <span>
                                                    {{Helpers::setting( 'site.adres' )}}
                                                </span>
                                            </figcaption>
                                        </figure>
                                    </div>
                                    <div class="col-sm-4">
                                        <figure class="text-center">
                                            <span class="icon icon-phone"></span>
                                            <figcaption>
                                                <strong>Telefon</strong>
                                                <span>
                                                    <strong>Gsm: </strong>{{Helpers::setting( 'site.phone_gsm' )}}
                                                </span>
                                            </figcaption>
                                        </figure>
                                    </div>
                                    <div class="col-sm-4">
                                        <figure class="text-center">
                                            <span class="icon icon-clock"></span>
                                            <figcaption>
                                                <strong>Çalışma Saatleri</strong>
                                                <span>
                                                    {!!Helpers::setting( 'site.calisma' )!!}
                                                </span>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </div>
                            </div>

                            <div class="banner">
                                <div class="row">
                                    <div class="col-md-offset-1 col-md-10 text-center">
                                        <h2 class="title">Bizimle iletişime geçin</h2>
                                        <p>
                                            Aşağıda ki formu doldurarak bizimle iletişime geçebilirisiniz.
                                        </p>

                                        <div class="contact-form-wrapper">

                                            <a class="btn btn-clean open-form" data-text-open="İletişim Formu"
                                                data-text-close="Formu Kapat">İletişim Formu</a>

                                            <div class="contact-form clearfix">
                                                <form action="{{ route('randevuolustur') }}" method="POST">
                                                    @csrf
                                                    @method('post')
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input required id="Name" name="data[][Adı]" type="text" value=""
                                                                    class="form-control" placeholder="Adınız">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input required id="Name" name="data[][Soyadı]" type="text" value=""
                                                                    class="form-control" placeholder="Soyadınız">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input required id="Email" name="data[][E-Posta]" type="E-Posta" value=""
                                                                    class="form-control" placeholder="E-Posta">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input required id="Subject" name="data[][Konu]" type="text" value=""
                                                                    class="form-control" placeholder="Konu">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <textarea required id="Comment" name="data[][Mesajınız]" class="form-control"
                                                                    placeholder="Mesajınız" rows="10"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 text-center">
                                                            <input type="submit" class="btn btn-clean"
                                                                value="Gönder">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!--col-sm-8-->
                </div>
                <!--/row-->
            </div>
            <!--/container-->
        </section>


    @endsection
