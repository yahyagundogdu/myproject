@extends('backend.app')

@section('cssAdd')
    @include('backend.include.datatable.datatableCssModule')

    <style>
        .photo_visible {
            max-width: 500px;
            max-height: 500px;
            height: auto;
            width: auto;
        }

    </style>
    <link rel="stylesheet" href="/backend/plugins/css/jquery-ui.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sayfa İşlemleri</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Sayfa İşlemleri</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header">
                        <h3 class="card-title">Sayfa İşlemleri</h3>
                    </div>

                    <div class="card-body">

                        @if (Session::has('errors'))
                            <div class="alert alert-danger" role="alert" auto-close="3000">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br />
                                @endforeach
                            </div>
                        @endif
                        @isset($sayfaDuzenle)
                            <form action="{{ route('admin.page.update', $sayfaDuzenle->id) }}" method="post"
                                enctype="multipart/form-data">
                                @method('patch')
                            @endisset
                            <form action="{{ route('admin.page.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="sub_page_id">Üst Sayfa</label>
                                    <select class="form-control" name="sub_page_id" id="sub_page_id">
                                        <option value="" disabled selected>Lütfen Sayfa Seçiniz</option>
                                        @foreach ($pages as $data)
                                            @php
                                                $id = $data->id;
                                            @endphp

                                            @if ($data->sub_page_id == null)
                                                <option value="{{ $data->id }}" @isset($sayfaDuzenle)
                                                        {{ $sayfaDuzenle->sub_page_id == $data->id ? 'selected' : '' }}
                                                    @endisset>
                                                    {{ $data->name }}</option>
                                            @endif
                                            @php
                                                $value = $data->children($id);
                                            @endphp
                                            @if ($value)
                                                @foreach ($value as $child)
                                                    <option value="{{ $child->id }}" @isset($sayfaDuzenle)
                                                            {{ $sayfaDuzenle->sub_page_id == $child->id ? 'selected' : '' }}
                                                        @endisset>
                                                       --{{ $child->name }}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Adı</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" placeholder="Başlık" @if (!isset($sayfaDuzenle)) value="{{ old('name') ? old('name') : '' }}" @endif @isset($sayfaDuzenle) value="{{ $sayfaDuzenle->name }}" @endisset required>
                                </div>
                                <div class="form-group">
                                    <label for="slug">Seo Url</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                        name="slug" placeholder="Seo Url" @if (!isset($sayfaDuzenle)) value="{{ old('slug') ? old('slug') : '' }}" @endif @isset($sayfaDuzenle) value="{{ $sayfaDuzenle->slug }}" @endisset required>
                                </div>
                                <div class="form-group">
                                    <label for="yayin">Yayın Durumu</label>
                                    <select class="form-control" name="yayin" id="yayin">
                                        <option value="1" @isset($sayfaDuzenle)
                                            {{ $sayfaDuzenle->active == 1 ? 'selected' : '' }} @endisset>Yayınla
                                        </option>
                                        <option value="0" @isset($sayfaDuzenle)
                                            {{ $sayfaDuzenle->active == 0 ? 'selected' : '' }} @endisset>Yayını Durdur
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="viewcontrol">Route | Url</label>
                                    <select class="form-control" name="viewcontrol" id="viewcontrol">
                                        <option value="1" @isset($sayfaDuzenle)
                                            {{ $sayfaDuzenle->urlcontrol == 1 ? 'selected' : '' }} @endisset>Özel Sayfa
                                        </option>
                                        <option value="0" @isset($sayfaDuzenle)
                                            {{ $sayfaDuzenle->urlcontrol == 0 ? 'selected' : '' }} @endisset>Sabit Sayfa
                                        </option>
                                    </select>
                                </div>
                                <input class="btn btn-success" name="newPage" type="submit" value="Kaydet">
                            </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scriptAdd')
@section('scriptAdd')
    <script src="https://cdn.ckeditor.com/4.16.1/standard-all/ckeditor.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#name").on('input', function() {

                setTimeout(function() {
                    var dInput = $('input:text[name=name]').val();
                    $.ajax({
                        type: "POST",
                        data: {
                            data: dInput,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('admin.ajax') }}',
                        success: function(data) {
                            console.log(data);
                            $("#slug").val(data);
                        },
                    });

                }, 0);
            });


            $('#lfm').filemanager('image');
            $('#remove-image').click(function() {
                $('#thumbnail').val("");
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
