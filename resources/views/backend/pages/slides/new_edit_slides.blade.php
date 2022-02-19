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
@endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Slider İşlemleri</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Slider İşlemleri</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header">
                        <h3 class="card-title">Slider İşlemleri</h3>
                    </div>

                    <div class="card-body">

                        @if (Session::has('errors'))
                            <div class="alert alert-danger" role="alert" auto-close="3000">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br />
                                @endforeach
                            </div>
                        @endif
                        @isset($sliderDuzenle)
                            <form action="{{ route('admin.slider.update', $sliderDuzenle->id) }}" method="post"
                                enctype="multipart/form-data">
                                @method('patch')
                            @endisset
                            <form action="{{ route('admin.slider.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <label>Fotoğraf</label>
                                @if (isset($sliderDuzenle) && $sliderDuzenle->photo != null)
                                    <div class="form-group text-center">
                                        <img src="{{ $sliderDuzenle->photo }}" class="photo_visible">
                                    </div>
                                @endif
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="thumbnail" {{ old('filepath') ? 'value=' . old('filepath') . '' : '' }}
                                            @isset($sliderDuzenle) value="{{ $sliderDuzenle->photo }}" @endisset
                                            class="form-control" type="text" name="filepath">
                                        <span class="input-group-btn">
                                            <a id="lfm" data-input="thumbnail" name="image" data-preview="holder"
                                                class="btn btn-primary">
                                                <i class="fas fa-images"></i> Görüntüle
                                            </a>
                                            <button role="button" id="remove-image" class="btn btn-danger" type="button">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title">Başlık</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                        name="title" placeholder="Başlık"
                                        {{ old('title') ? 'value=' . old('title') . '"' : '' }} @isset($sliderDuzenle)
                                        value="{{ $sliderDuzenle->title }}" @endisset>
                                </div>
                                <div class="form-group">
                                    <label for="subtext">Alt Başlık</label>
                                    <textarea class="form-control" id="subtext2" name="subtext" rows="3">{{{old('subtext')}}}@isset($sliderDuzenle){{$sliderDuzenle->subtext}}@endisset</textarea>
                                </div>
                                <input class="btn btn-success" type="submit" value="Kaydet">
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
