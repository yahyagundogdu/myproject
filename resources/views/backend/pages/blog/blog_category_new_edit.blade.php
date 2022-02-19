@extends('backend.app')

@section('cssAdd')
    @include('backend.include.datatable.datatableCssModule')
    <link rel="stylesheet" href="/backend/plugins/css/jquery-ui.min.css">
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Kategori İşlemleri</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Kategori</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row mb-3">
                            <div class="col-12">
                                <a class="btn btn-primary" href="{{ route('admin.category') }}"><i
                                        class="fas fa-arrow-left"></i> Kategoriler</a>
                            </div>
                        </div>
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Kategori</h3>
                            </div>

                            <div class="card-body">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger" role="alert" auto-close="3000">
                                        {{ $error }}
                                    </div>
                                @endforeach
                                @isset($kategoriDuzenle)
                                    <form action="{{ route('kategori.update', $kategoriDuzenle->id) }}" method="POST">
                                        @method('patch')
                                    @endisset
                                    <form action="{{ route('kategori.store') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Kategori Adı</label>
                                            <input type="name" name="name"
                                                class="form-control @error('name') is-invalid @enderror" id="name"
                                                @isset($kategoriDuzenle) value="{{ $kategoriDuzenle->category_name }}" @endisset
                                                placeholder="Kategori Adı">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary" name="blogkayit" value="Kaydet">
                                        </div>
                                    </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
@section('scriptAdd')
<script>
    var alert = $('div.alert[auto-close]');
            alert.each(function() {
                var that = $(this);
                var time_period = that.attr('auto-close');
                setTimeout(function() {
                    that.alert('close');
                }, time_period);
            });
</script>
@endsection
