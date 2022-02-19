@extends('frontend.app')

@section('title',$page->title.' - ')
@section('keywords', $page->keywords)
@section('description',$page->description)

@section('content')
    <header class="header-bottom-4">
        <img src="{{ Storage::url(Helpers::setting( 'sayfa_banner' ))}}">

        <div class="container">
            <h1 class="section-title">HAKKIMIZDA</span></h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('frontend.index')}}">Ana Sayfa</a></li>
                <li class="breadcrumb-item active">HAKKIMIZDA</li>
            </ol>
        </div>
    </header>
    <section class="about-4" id="about">
        <div class="latest-news__bg">
            <div class="icon">
                <img src="/frontend/images/png-shapes/latest-news__right-bottom-shape.png">
            </div>
        </div>
        <div class="container">
            <div class="content">
                <div class="video">
                    <div class="img">
                        <img src="{{Storage::url($page->resim)}}">
                    </div>
                </div>
                <div class="content-right">
                    <h4>{{$page->baslik_1}}</h4>
                    <h1 class="section-title"><span>{{$page->buyuk_baslik_1}}</span> </h1>
                    <h2>{{$page->alt_baslik}}.</h2>
                    {!!$page->acikalma!!}
                </div>
            </div>
        </div>
    </section>
    {{Helpers::Call()}}
@endsection
