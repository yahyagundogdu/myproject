<div class="header-bottom__banner owl-carousel owl-theme">

    @foreach ($slide as $data)
    <div class="slide-item">
        <img src="{{ $data->photo }}">
        <div class="container">
            <div class="slide-item__block">
                <h1 class="slide-item__title">{{ $data->title }}
                </h1>
                <h4 class="slide-item__subtitle">{{ $data->subtext }}</h4>
            </div>
        </div>
    </div>
    @endforeach
</div>
