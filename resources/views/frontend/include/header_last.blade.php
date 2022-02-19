<header class="header-middle header-middle_white-transparent">
    <div class="container">


        <div class="navbar-logo">
            <a href="{{route('frontend.index')}}">
                <img width="200" height="50" src="{{Storage::url(Helpers::setting( 'site.logo_mobil' ))}}" alt="Logo">
            </a>
        </div>

        <div class="navbar-icon">
            <span></span>
        </div>



        <div class="navbar">
            {{ Helpers::menu() }}
            <div class="navbar__right">
                <a href="#" class="btn btn_pink" id="popup-form-open">Randevu</a>
            </div>
        </div>

    </div>
</header>
