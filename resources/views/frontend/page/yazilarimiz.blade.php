@extends('frontend.app')

@section('title',$page->title.' - ')
@section('keywords', $page->keywords)
@section('description',$page->description)

@section('content')
    <header class="header-bottom-4">
        <img src="{{ Storage::url(Helpers::setting( 'sayfa_banner' ))}}">
        <div class="container">
            <h1 class="section-title">TEDAVİLER</span></h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('frontend.index')}}">Ana Sayfa</a></li>
                <li class="breadcrumb-item active">TEDAVİLER</li>
            </ol>
        </div>
    </header>

    <section class="latest-news-4 main-blog">
        <div class="container">
            @isset($blog)
                @foreach ($blog as $item)
                    <a href="{{ route('blogPage', $item->slug) }}" class="item">
                        <div class="img">
                            <img src="{{ $item->photo }}" alt="{{ $item->title }}">
                            <span class="date">{{ $item->updated_at->translatedFormat('d-M-Y') }}</span>
                        </div>
                        <h4 class="title">{{ $item->title }}</h4>
                        <p class="text">
                            {{ Str::limit(strip_tags(html_entity_decode($item->body, ENT_COMPAT, 'UTF-8')), 150) }}
                        </p>
                        <span class="read-more-2">Devamını Oku</span>
                    </a>
                @endforeach
                {{ $blog->links('frontend.paginator') }}
            @else
            <div class="alert alert-info">
                Herhangi Bir yazı bulunamadı
            </div>
            @endisset

        </div>
    </section>
    {{Helpers::Call()}}
@endsection
