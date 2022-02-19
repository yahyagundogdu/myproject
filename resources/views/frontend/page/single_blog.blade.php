@extends('frontend.app')

@section('title', Str::limit($blog->title,60).' -')
@section('keywords', json_decode($blog->anahtar))
@section('description',Str::limit(str_replace("\n","",strip_tags(html_entity_decode($blog->body, ENT_COMPAT, 'UTF-8'))),160))

@section('content')

<header class="header-bottom-4">
    <img src="{{ Storage::url(Helpers::setting( 'sayfa_banner' ))}}">
    <div class="container">
        <h1 class="section-title">{{ $blog->title }}</span></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Ana Sayfa</a></li>
            <li class="breadcrumb-item active">{{ $blog->title }}</li>
        </ol>
    </div>
</header>
<!-- End of .header-bottom-4 -->

<!-- Start of .latest-news-4 -->
<section class="latest-news-4 main-blog">
    <div class="main-blog__bg">
        <div class="icon">
            <img src="/frontend/images/png-shapes/form-shape.png">
        </div>
        <div class="icon">
            <img src="/frontend/images/png-shapes/specialists__left-bottom-shape.png">
        </div>
    </div>
    <div class="container container_right-sidebar">

        <div class="article">
            <div class="single-card">
                <div class="img">
                    @if ($blog->photo)
                    <img src="{{$blog->photo}}"  style="width: 100%;">
                    @endif
                </div>
                <span class="date">{{ $blog->updated_at->translatedFormat('d-M-Y') }}</span>
                <h1 class="title">{{ $blog->title }}</h1>
                <p class="text">
                    {!! $blog->body !!}
                </p>
            </div>
        </div>
        <div class="sidebar">
            <div class="blog-sidebar">
                <div class="categories">
                    <h1 class="blog-sidebar-title">Yazılar</h1>
                    <ul class="lists">
                        @foreach ($blogs as $lastblog )
                        <li class="item">
                            <a href="{{ route('blogPage', $lastblog->slug) }}">
                                <span class="name">{{$lastblog->title}}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="departments-sidebar">
                <div class="appointment">
                    <h1 class="title">Randevu Alın</h1>
                    <form class="appointment-form" action="{{ route('randevuolustur') }}" method="POST">
                            @csrf
                            @method('post')
                        <input type="hidden" name="formPath" value="{{$blog->title}}">
                        <input type="text" name="data[][Adı]"placeholder="Adınız">
                        <input type="text" name="data[][Soyadı]"placeholder="Soyadınız">
                        <input type="email" name="data[][Email]" placeholder="E-Posta">
                        <textarea name="data[][Mesaj]" placeholder="Mesajınız"></textarea>
                        <button type="submit" class="btn btn_pink">Randevu Al</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
