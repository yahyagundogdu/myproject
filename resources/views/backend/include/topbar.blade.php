<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-sm-inline-block">
        <a class="btn btn-sm btn-success m-1" target="_blank" href="{{route('frontend.index')}}" class="nav-link">Siteyi Görüntüle</a>
      </li>
      <li class="nav-item d-sm-inline-block">
        <a class="btn btn-sm btn-primary m-1" href="{{route('admin.dashboard')}}" class="nav-link">Ana Sayfa</a>
      </li>
    </ul>


    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="{{Storage::url(Auth::user()->photo)}}" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline"></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

          <li class="user-header bg-primary">
            <img src="{{Storage::url(Auth::user()->photo)}}" class="img-circle elevation-2" alt="User Image">

            <p>
               <b>Adı:</b> {{Auth::user()->name}}
            </p>
            <p>
                <b>Rol:</b>
                @foreach (Auth::user()->roles as $role )
                    {{$role->name}}
                @endforeach
            </p>
          </li>
          <li class="user-footer">
            <a href="{{ route('admin.user.edit', Auth::user()->id) }}" class="btn btn-default btn-flat">Profil</a>
            <a class="btn btn-default btn-flat float-right" href="{{route('admin.logout')}}">Çıkış Yap</a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
