@extends('frontend.app')

@php
$json_decode = null;
$json_decode[] = json_decode($data->data, true);
$slug=Str::slug( $json_decode[0][1]['data_value']);
@endphp

@section('title',$slug.' -')
@section('keywords', 'İletişim,Göç Danışmanlık, Göç Randevu')
@section('description',Str::limit(str_replace("\n","",strip_tags(html_entity_decode($json_decode[0][2]['data_value'], ENT_COMPAT, 'UTF-8'))),160))

@section('content')
    <!-- Start of .header-bottom-4 -->
    <header class="header-bottom-4">
        <img src="{{ Storage::url(Helpers::setting( 'sayfa_banner' ))}}">
        <div class="container">
            <h1 class="section-title">{{ $json_decode[0][1]['data_value'] }}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('frontend.index')}}">Ana Sayfa</a></li>
                <li class="breadcrumb-item"><a href="{{route('ekibimiz')}}">Ekibimiz</a></li>
                <li class="breadcrumb-item active">{{ $json_decode[0][1]['data_value'] }}</li>
            </ol>
        </div>
    </header>
    <!-- End of .header-bottom-4 -->

    <!-- Start of .doctors -->
    <section class="doctors main-blog">
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
                <div class="doctors-block">
                    <div class="img">
                        <img src="{{ $json_decode[0][0]['data_value'] }}">
                    </div>
                    <div class="content">
                        <table>
                            <thead>
                                <td colspan="2">
                                    <h1 class="title">{{ $json_decode[0][1]['data_value'] }}</h1>
                                    <h1 class="profession">{{ $json_decode[0][2]['data_value'] }}</h1>
                                </td>
                            </thead>
                        </table>
                        <p class="text">
                            {!! $json_decode[0][3]['data_value'] !!}
                        </p>
                    </div>
                </div>
                <div class="doctors-text">

                </div>
            </div>
        </div>
    </section>
@endsection
