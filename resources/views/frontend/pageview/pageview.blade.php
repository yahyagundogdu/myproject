@extends('frontend.app')


@section('title', Str::limit($pagefeature->title, 80).' -' )
@section('keywords', Str::limit($pagefeature->key,160))
@section('description', Str::limit(str_replace("\n","",strip_tags(html_entity_decode($pagefeature->icerik, ENT_COMPAT, 'UTF-8'))),160))
@section('sidebar-true', 'sidebar-true')

@section('cssAdd')
    <style>
        #content>p {
            height: auto;
        }

        #content>p>img {
            max-width: 100%;
            object-fit: contain;
            object-position: top;
            height: auto;
        }

    </style>
@endsection
@section('content')

    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-box ttm-textcolor-white">
                        <div class="page-title-heading">
                            <h1 class="title">{{ $pagefeature->baslik }}</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span>
                                <a title="Ana Sayfa" href="{{ route('anasayfa') }}"><i
                                        class="ti ti-home"></i>&nbsp;&nbsp;Ana Sayfa</a>
                            </span>
                            <span class="ttm-bread-sep">&nbsp; | &nbsp;</span>
                            <span> {{ $page->name }} </span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="site-main">
        <div class="sidebar ttm-sidebar-right ttm-bgcolor-white clearfix">
            <div class="container">

                <div class="row">
                    @php
                        $value = $page->children($page->sub_page_id);
                    @endphp


                    <div class="{{ count($value) > 1 ? 'col-lg-9' : 'col-lg-12' }} content-area pull-left">

                        <article class="post ttm-blog-classic">
                            <div class="featured-imagebox featured-imagebox-post">
                                @if (Helpers::site('resim', $page->id))
                                    <div class="featured-thumbnail">
                                        <img class="img-fluid" src="{{ Storage::url($pagefeature->resim) }}"
                                            alt="{{ $page->name }}">
                                    </div>
                                @endif
                                <div class="featured-content featured-content-post">
                                    @if (Helpers::site('resim', $page->id))
                                        <div class="separator">
                                            <div class="sep-line solid mt-10 mb-20"></div>
                                        </div>
                                    @else
                                        <h5>{{ $page->name }}</h5>
                                    @endif
                                    <div class="row">
                                        <div class="col-12" id="content">
                                            {!! $pagefeature->icerik !!}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </article>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="map-col-bg ttm-bgcolor-skincolor p-5">

                                    <div class="section-title text-left with-desc clearfix">
                                        <div class="title-header">
                                            <h3 class="title text-white">Hızlı Randevu Alın</h3>
                                        </div>
                                    </div>
                                    <form id="ttm-contactform" class="ttm-contactform wrap-form clearfix" method="post" action="{{ route('randevuolustur') }}">
                                        @csrf
                                        @method('post')
                                        <input type="hidden" name="formPath" value="{{$page->name}}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>
                                                    <span class="text-input">
                                                        <input name="data[][Adı]" type="text" required
                                                            placeholder="Adınız" required="required">
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>
                                                    <span class="text-input">
                                                        <input name="data[][Soyadı]" type="text" required
                                                            placeholder="Soyadınız" required="required">
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>
                                                    <span class="text-input">
                                                        <input name="data[][Email]" type="email"  required
                                                            placeholder="E-Posta" required="required">
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>
                                                    <span class="text-input">
                                                        <input name="data[][Telefon]" type="text" required
                                                            placeholder="Telefon Numaranız" required="required">
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <input name="submit" type="submit" id="submit" onclick="this.disabled=true;this.parentNode.submit();"
                                            class="submit ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-bgcolor-darkgrey"
                                            value="Randevu Al">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (count($value) > 1)
                        <div class="col-lg-3 widget-area ttm-bgcolor-white pull-right">
                            <aside class="widget post-widget">
                                <h3 class="widget-title">Sayfalar</h3>

                                <ul class="widget-post ttm-recent-post-list">
                                    @foreach ($value as $child)
                                        <li>
                                            <a href="{{ route('allPage', $child->slug) }}"
                                                class="clearfix">{{ $child->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </aside>
                        </div>
                    @endif

                </div>

            </div>
        </div>

    </div>
@endsection
