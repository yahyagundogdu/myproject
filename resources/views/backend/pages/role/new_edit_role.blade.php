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
                        <h1>Rol İşlemleri</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Roller</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container" style="padding-bottom: 20px">
                <div class="row">
                    <div class="col-12">
                        <div class="row mb-3">
                            <div class="col-12">
                                <a class="btn btn-primary" href="{{ route('admin.role') }}"><i class="fas fa-arrow-left"></i> Roller</a>
                            </div>
                        </div>
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header">

                                <h3 class="card-title">Roller</h3>
                            </div>

                            <div class="card-body">
                                @foreach ($errors->all() as $error)
                                <div class="alert alert-danger" role="alert" auto-close="3000">
                                    {{ $error }}
                                </div>
                                @endforeach
                                @isset($rolDuzenle)
                                    <form action="{{ route('roller.update', $rolDuzenle->id) }}" method="POST">
                                        @method('patch')
                                    @endisset
                                    <form action="{{ route('roller.store') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Rol Adı</label>
                                            <input type="name" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                                @isset($rolDuzenle) value="{{ $rolDuzenle->name }}" @endisset
                                                placeholder="Rol Adı">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary" name="rolkayit" value="Kaydet">
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
@endsection
