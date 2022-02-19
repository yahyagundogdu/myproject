@extends('frontend.app')

@push('css')
    <style>
        .latest-news-4>.container {
            justify-content: left;
        }

        .latest-news-4>.container>.item>.img {
            height: 180px;
        }

        .latest-news-4>.container {
            justify-content: center;
        }

    </style>
@endpush

@section('content')
    <header class="header-bottom-4">
        <img src="{{ Storage::url(Helpers::setting('sayfa_banner')) }}">
        <div class="container">
            <h1 class="section-title"><span>GALERİ</span></h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Ana Sayfa</a></li>
                <li class="breadcrumb-item active">GALERİ</li>
            </ol>
        </div>
    </header>
    <section class="latest-news-4 main-blog">
        <div class="container ">
            @foreach ($gallery as $gallery)
                <a href="{{ route('resimdetay', $gallery->slug) }}" class="item p-1">
                    <div class="img">
                        <img style="width: 100%;height: 200px;object-fit: cover;"
                            src="{{ $gallery->getfirstimage ? $gallery->getfirstimage->path : Storage::url(Helpers::setting('site.galeri-sabit-fotograf')) }}">
                    </div>
                    <h4 class="title text-center">{{ $gallery->name }}</h4>
                </a>
            @endforeach
        </div>
    </section>
@endsection
