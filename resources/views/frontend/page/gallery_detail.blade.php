@extends('frontend.app')
@push('css')

    <link rel="stylesheet" href="/frontend/fancybox/jquery.fancybox.css">
    <style>
        .plyr__video-embed {
            width: 100%;
            height: 100%;
            padding: 0px;
            margin: 0px;
        }

        .latest-news-4 {
            padding: 30px 0;
        }

    </style>
@endpush
@section('content')
    <header class="header-bottom-4">
        <img src="{{ Storage::url(Helpers::setting('sayfa_banner')) }}">

        <div class="container">
            <h1 class="section-title">GALERİ</span></h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Ana Sayfa</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('resimler') }}">GALERİ</a></li>
                <li class="breadcrumb-item active">{{ $gallery->name }}</li>
            </ol>
        </div>
    </header>
    <section class="latest-news-4 main-blog">
        <div class="container">

            @if (!$gallery_data)
                <div class="alert alert-warning" role="alert">
                    Herhangi bir resim bulunamadı.
                </div>
            @else
                <p>
                <div class="row ">
                    @foreach ($gallery_data as $gallery)
                        <div class="col-md-6 col-lg-4 mt-3 text-center">
                            @if ($gallery->type == 0)
                                <div style="width: 100%;height: 200px;">
                                    <a data-fancybox="gallery" data-src="{{ $gallery->path }}">
                                        <img src="{{ $gallery->path }}"
                                            style="width: 100%;height: 200px;object-fit: cover;" />
                                    </a>
                                </div>

                            @else
                                <div style="width: 100%;height: 200px;">
                                    <a data-fancybox-plyr href="{{ $gallery->video_path }}"><img class="inline"
                                            style="width: 100%;height: 200px;object-fit: cover;"
                                            src="{{ $gallery->path }}" /></a>
                                </div>
                            @endif


                        </div>

                    @endforeach

                </div>


                </p>
            @endif
        </div>
    </section>
@endsection

@push('script')
    <script type="text/javascript" src="/frontend/fancybox/jquery.fancybox.min.js"></script>
    <script>
        Fancybox.bind("[data-fancybox-plyr]", {
            on: {
                reveal: (fancybox, slide) => {
                    if (typeof Plyr === undefined) {
                        return;
                    }

                    let $el;

                    if (slide.type === "html5video") {
                        $el = slide.$content.querySelector("video");
                    } else if (slide.type === "video") {
                        $el = document.createElement("div");
                        $el.classList.add("plyr__video-embed");

                        $el.appendChild(slide.$iframe);

                        slide.$content.appendChild($el);
                    }

                    if ($el) {
                        slide.player = new Plyr($el);
                    }
                },
                "Carousel.unselectSlide": (fancybox, carousel, slide) => {
                    if (slide.player) {
                        slide.player.pause();
                    }
                },
                "Carousel.selectSlide": (fancybox, carousel, slide) => {
                    if (slide.player) {
                        slide.player.play();
                    }
                },
            },
        });
    </script>
@endpush
