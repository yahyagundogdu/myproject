@extends('backend.app')

@section('cssAdd')
    @include('backend.include.datatable.datatableCssModule')

    <style>
        .photo_visible {
            max-width: 200px;
            max-height: 200px;
            height: auto;
            width: auto;
        }

    </style>
    <link rel="stylesheet" href="/backend/plugins/css/jquery-ui.min.css">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Kullanıcı İşlemleri</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Kullanıcı İşlemleri</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container pb-2">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header">
                        <h3 class="card-title">Kullanıcı İşlemleri</h3>
                    </div>

                    <div class="card-body">
                        @if (Session::has('errors'))
                            <div class="alert alert-danger" role="alert" auto-close="3000">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br />
                                @endforeach
                            </div>
                        @endif
                        @isset($userDuzenle)
                            <form action="{{ route('admin.user.update', $userDuzenle->id) }}" method="post"
                                enctype="multipart/form-data">
                                @method('patch')
                            @endisset
                            <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    @isset($userDuzenle)
                                        @if (Storage::exists('public/' . $userDuzenle->photo))
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <img class="photo_visible mb-2"
                                                        src="{{ Storage::url($userDuzenle->photo) }}">
                                                </div>
                                            </div>
                                        @endif
                                    @endisset

                                    <label for="email">Fotoğraf</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                        name="image" {{ old('image') ? 'value=' . old('image') : '' }}
                                        placeholder="resim">
                                </div>
                                <div class="form-group">
                                    <label for="name">Adı Soyadı</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" placeholder="Adı"
                                        {{ old('name') ? 'value=' . old('name')  : '' }} @isset($userDuzenle)
                                        value="{{ $userDuzenle->name }}" @endisset required>
                                </div>
                                <div class="form-group">
                                    <label for="email">E-Posta</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                        name="email" {{ old('email') ? 'value=' . old('email') : '' }}
                                        @isset($userDuzenle) value="{{ $userDuzenle->email }}" @endisset
                                        placeholder="E-Posta" required>
                                </div>
                                <div class="form-group">
                                    <label for="role">Rol</label>
                                    <select name="role" id="role" class="form-control @error('role') is-invalid @enderror"
                                        name="role" id="role" required>
                                        @foreach ($role as $data)
                                            <option @isset($userDuzenle) @if ($userDuzenle->hasRole($data->name)==$data->name) selected @endif @endisset
                                                value="{{ $data->name }}">
                                                {{ $data->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="password">Parola</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Parola">
                                </div>
                                <div class="form-group">
                                    <label for="password">Parola Doğrula</label>
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation" name="password_confirmation"
                                        placeholder="Parola Doğrulama">
                                </div>
                                <input name="yenikullanici" class="btn btn-success" type="submit" value="Kaydet">
                            </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scriptAdd')
    @include('backend.include.datatable.datatableScriptModule')
    <script>
        $(function() {
            $("#users").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
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
        });
    </script>
@endsection
