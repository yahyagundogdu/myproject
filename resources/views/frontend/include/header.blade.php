<nav class="navbar-fixed">

    <div class="container">
        <div class="navigation navigation-top clearfix">
            <ul>
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                <li class="nav-settings">
                    <a href="javascript:void(0);" class="nav-settings-value">TR</a>
                    <ul class="nav-settings-list">
                        <li>TR</li>
                        <li>ENG</li>
                        <li>لعربية</li>
                    </ul>
                </li>
                </li>
            </ul>
        </div>
        <div class="navigation navigation-main">
            <a href="{{ route('frontend.index') }}" class="logo"><img
                    src="{{ Storage::url(Helpers::setting('site.logo')) }}" /></a>
            <a href="#" class="open-menu"><i class="icon icon-menu"></i></a>
            <div class="floating-menu">
                <div class="close-menu-wrapper">
                    <span class="close-menu"><i class="icon icon-cross"></i></span>
                </div>
                {{ Helpers::menu() }}
            </div>
        </div>
    </div>
</nav>
