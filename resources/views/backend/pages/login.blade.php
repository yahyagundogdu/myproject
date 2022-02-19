<!DOCTYPE html>
<html lang="TR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ASSAPARS ADMİN PANEL</title>

    @include('backend.include.css')
    @section('cssAdd')
        <link rel="stylesheet" href="/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    @endsection
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <div class="row">
                <div class="col-12">
                    <img src="{{Storage::url(Helpers::setting( 'admin.logo' ))}}" style="width: 100px;height: 100px;" alt="AssaPars" class="brand-image img-circle elevation-3" style="opacity: .8">
                </div>
                <div class="col-12">
                    <a href="{{ url('/') }}"><b>{{ Helpers::setting( 'admin.title' ) }}</a>

                </div>
            </div>

        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Lütfen Giriş Yapınız</p>

                @if (Session::has('error'))
                    <div class="alert alert-danger" role="alert" auto-close="3000">
                        {{ session('error') }}
                    </div>
                @elseif (Session::has('success'))
                    <div class="alert alert-success" role="alert" auto-close="3000">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('admin.authenticate') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input class="form-control @error('email') is-invalid @enderror" type="email" required
                            name="email" value="{{ old('email') }}" class="form-control" placeholder="E Posta">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input class="form-control @error('password') is-invalid @enderror" required type="password"
                            name="password" required class="form-control" placeholder="Parola">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">
                                    Beni Hatırla
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Giriş Yap</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('backend.include.script')
    <script>
        $(function() {
            var alert = $('div.alert[auto-close]');
            alert.each(function() {
                var that = $(this);
                var time_period = that.attr('auto-close');
                setTimeout(function() {
                    that.alert('close');
                }, time_period);
            });
        });
    </script>
</body>

</html>
