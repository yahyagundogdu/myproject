@extends('backend.app')

@section('cssAdd')
    @include('backend.include.datatable.datatableCssModule')
    <link rel="stylesheet" href="/backend/plugins/css/jquery-ui.min.css">

    <style>
        .photo_visible {
            max-width: 500px;
            max-height: 500px;
            height: auto;
            width: auto;
        }

    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Galeri Kategori İşlemleri</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Galeri Kategori</li>
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
                                <a class="btn btn-primary" href="{{ route('galeri-kategori.index') }}"><i
                                        class="fas fa-arrow-left m-1"></i>Galeri Kategorileri</a>
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
                                @isset($fotografDuzenle)
                                    <form action="{{ route('galeri.update', $fotografDuzenle->id) }}" method="POST">
                                        @method('patch')
                                    @endisset
                                    <form action="{{ route('galeri.store') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Fotoğraf</label>
                                            @if (isset($fotografDuzenle) && $fotografDuzenle->path != null)
                                                <div class="form-group">
                                                    <img src="{{ $fotografDuzenle->path }}" class="photo_visible">
                                                </div>
                                            @endif
                                            <div class="input-group">
                                                <input id="thumbnail"
                                                    {{ old('filepath') ? 'value=' . old('filepath') . '' : '' }}
                                                    @isset($fotografDuzenle)
                                                    value="{{ $fotografDuzenle->path }}" @endisset class="form-control"
                                                    type="text" name="filepath">
                                                <span class="input-group-btn">
                                                    <a id="lfm" data-input="thumbnail" name="image" data-preview="holder"
                                                        class="btn btn-primary">
                                                        <i class="fas fa-images"></i> Görüntüle
                                                    </a>
                                                    <button role="button" id="remove-image" class="btn btn-danger"
                                                        type="button">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Kategori Adı</label>
                                            <select name="category_id" class="form-control">
                                                <option>Lütfen seçiniz</option>
                                                @foreach ($category as $value)
                                                    <option value="{{ $value->id }}" @isset($fotografDuzenle)
                                                            {{ $fotografDuzenle->category_id == $value->id ? 'selected' : '' }}
                                                        @endisset>{{ $value->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="name">Tip</label>
                                            <select name="type" class="form-control">
                                                <option>Lütfen seçiniz</option>
                                                <option value="0" @isset($fotografDuzenle)
                                                    {{ $fotografDuzenle->type == 0 ? 'selected' : '' }} @endisset>Fotoğraf
                                                </option>
                                                <option value="1" @isset($fotografDuzenle)
                                                    {{ $fotografDuzenle->type == 1 ? 'selected' : '' }} @endisset>Video</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Video Url <small>(Eğer video paylaşacaksanız Bu alanı doldurun)</small> </label>
                                            <input type="text" name="video_path" class="form-control"
                                            @isset($fotografDuzenle)
                                                   value= {{ $fotografDuzenle->video_path }}
                                            @endisset
                                            >
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary" value="Kaydet">
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
    <script src="https://cdn.ckeditor.com/4.16.1/standard-all/ckeditor.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#lfm').filemanager('image');
        $('#remove-image').click(function() {
            $('#thumbnail').val("");
        });

        CKEDITOR.replace('body', {
            toolbar: [{
                    name: 'document',
                    items: ['Print']
                },
                {
                    name: 'clipboard',
                    items: ['Undo', 'Redo']
                },
                {
                    name: 'styles',
                    items: ['Format', 'Font', 'FontSize']
                },
                {
                    name: 'colors',
                    items: ['TextColor', 'BGColor']
                },
                {
                    name: 'align',
                    items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
                },
                '/',
                {
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat',
                        'CopyFormatting'
                    ]
                },
                {
                    name: 'links',
                    items: ['Link', 'Unlink']
                },
                {
                    name: 'paragraph',
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                        'Blockquote'
                    ]
                },
                {
                    name: 'insert',
                    items: ['Image', 'Table']
                },
                {
                    name: 'tools',
                    items: ['Maximize']
                },
                {
                    name: 'editing',
                    items: ['Scayt']
                }
            ],

            extraAllowedContent: 'h3{clear};h2{line-height};h2 h3{margin-left,margin-top}',


            extraPlugins: 'print,format,font,colorbutton,justify,uploadimage',
            uploadUrl: '/apps/ckfinder/3.4.5/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',


            filebrowserImageBrowseUrl: '/admin/filemanager?type=Images',
            filebrowserImageUploadUrl: '/admin/filemanager/upload?type=Images&_token={{ csrf_token() }}',
            filebrowserBrowseUrl: '/admin/filemanager?type=Files',
            filebrowserUploadUrl: '/admin/filemanager/upload?type=Files&_token={{ csrf_token() }}',

            height: 200,

            removeDialogTabs: 'image:advanced;link:advanced',
            language: 'tr'
        });
        $("#title").on('mouseover mouseout keypress focusout', function() {

            setTimeout(function() {
                var dInput = $('input:text[name=title]').val();
                $.ajax({
                    type: "POST",
                    data: {
                        data: dInput,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('admin.ajax') }}',
                    success: function(data) {
                        $("#slug").val(data);
                    },
                });

            }, 0);
        });
        var input = document.querySelector('textarea[name=anahtar]'),
            tagify = new Tagify(input, {
                delimiters: null,
                callbacks: {
                    add: console.log,
                    remove: console.log
                }
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
</script> @endsection
