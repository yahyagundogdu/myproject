<section class="header-content">
    <div class="owl-slider">
        @foreach ($slide as $data)
            <div class="item" style="background-image:url({{ $data->photo }})">
                <div class="box">
                    <div class="container">
                        <h2 class="title animated h1" data-animation="fadeInDown">{{ $data->title }}</h2>
                        <div class="animated" data-animation="fadeInUp">
                            {{ $data->subtext }}
                        </div>
                        <div class="animated" data-animation="fadeInUp">
                            <a href="https://themeforest.net/item/mobel-furniture-website-template/20382155"
                                target="_blank" class="btn btn-main"><i class="icon icon-cart"></i>İletişim</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
