<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{Helpers::setting( 'admin.title' )}}</title>
  <link rel="icon" href="{{Storage::url(Helpers::setting( 'admin.icon' ))}}" type="image/x-icon" />
  @include('backend.include.css')
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">
  @include('backend.include.topbar')

  @include('backend.include.leftnavbar')


  @yield('content')

  @include('backend.include.footer')


  <aside class="control-sidebar control-sidebar-dark">

  </aside>

</div>

@include('sweetalert::alert')
@include('backend.include.script')
</body>

</html>
