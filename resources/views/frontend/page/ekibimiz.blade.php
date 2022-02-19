@extends('frontend.app')

@section('title',$page->title.' - ')
@section('keywords', $page->keywords)
@section('description',$page->description)

@section('content')
    <header class="header-bottom-4">
        <img src="{{ Storage::url(Helpers::setting( 'sayfa_banner' ))}}">
        <div class="container">
            <h1 class="section-title"><span>EKİBİMİZ</span></h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Ana Sayfa</a></li>
                <li class="breadcrumb-item active">EKİBİMİZ</li>
            </ol>
        </div>
    </header>
    <section class="doctors main-blog">
        <div class="main-blog__bg">
            <div class="icon">
                <img src="/frontend/images/png-shapes/form-shape.png">
            </div>
            <div class="icon">
                <img src="/frontend/images/png-shapes/specialists__left-bottom-shape.png">
            </div>
        </div>
        <div class="container">

            <div class="doctors__cards row">

                @foreach ($data as $value)
                    @php
                        $json_decode = null;
                        $json_decode[] = json_decode($value->data, true);

                    @endphp

                    <div class="col-md-4 doctors__cards-item">
                        <a href="{{route('ekibimiz.show',$data[$loop->iteration-1]['id'])}}">
                            <div class="img">
                                <img src="{{ $json_decode[0][0]['data_value'] }}">
                            </div>
                            <div class="content">
                                <h1 class="name">{{ $json_decode[0][1]['data_value'] }}</h1>
                                <p class="profession">{{ $json_decode[0][2]['data_value'] }}</p>
                                <p class="text">
                                    {{ Str::limit(strip_tags(html_entity_decode($json_decode[0][3]['data_value'], ENT_COMPAT, 'UTF-8')), 150)  }}
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{Helpers::Call()}}
@endsection
