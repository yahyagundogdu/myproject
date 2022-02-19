<header class="header-bottom">

    @include('frontend.include.slider')


    <div class="services">
        <div class="container">
            <div class="services__items owl-carousel owl-theme">
                @foreach ($cart as $cart_data)
                    @php
                        $json_decode = null;
                        $json_decode[] = json_decode($cart_data->data, true);
                    @endphp
                    <a href="{{$json_decode[0][3]['data_value']}}">
                    <div class="services__outer-item">
                        <div class="services__item">
                            <div class="services__item-icon">
                                <img src="{{$json_decode[0][0]['data_value']}}" style="width: 90px;height: 93px;">
                            </div>
                            <h1 class="services__item-title">{{$json_decode[0][1]['data_value']}}</h1>
                        </div>
                    </div>
                </a>
                @endforeach

                </a>

            </div>
        </div>
    </div>

</header>
