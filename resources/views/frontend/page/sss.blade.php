@extends('frontend.app')

@section('title',$page->title.' - ')
@section('keywords', $page->keywords)
@section('description',$page->description)

@section('content')
    <header class="header-bottom-4">
        <img src="{{ Storage::url(Helpers::setting( 'sayfa_banner' ))}}">

        <div class="container">
            <h1 class="section-title">SIKÇA SORULAN <span>SORULAR</span></h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Ana Sayfa</a></li>
                <li class="breadcrumb-item active">SIKÇA SORULAN SORULAR</li>
            </ol>
        </div>
    </header>
    <section class="faqs main-blog">
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
                <div class="faqs__cards faqsFilterContainer">
                    @foreach ($data as $value)
                        @php
                            $json_decode = null;
                            $json_decode[] = json_decode($value->data, true);
                        @endphp
                        <div class="faqs__cards-item show">
                            <h2 class="faqs__cards-item-title">
                                <span>{{$loop->iteration}}.</span>
                                {{ $json_decode[0][0]['data_value'] }}
                                <i class="fa fa-angle-down"></i>
                            </h2>
                            <p class="faqs__cards-item-text">
                                {!! $json_decode[0][1]['data_value'] !!}
                            </p>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection
