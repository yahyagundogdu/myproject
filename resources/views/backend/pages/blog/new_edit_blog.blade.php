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
    <link rel="stylesheet" href="/backend/plugins/tagify/tagify.css">
    <script src="/backend/plugins/tagify/tagify.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Blog İşlemleri</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Blog İşlemleri</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                @isset($blogDuzenle)
                    <form action="{{ route('admin.blog.update', $blogDuzenle->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                    @else
                        <form action="{{ route('admin.blog.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                        @endisset

                        <div class="row mb-3">
                            <div class="col-12">
                                <a class="btn btn-primary" href="{{ route('admin.blogs') }}"><i
                                        class="fas fa-arrow-left"></i> Bloglar</a>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-8">
                                <div class="card card-primary card-outline card-tabs">
                                    <div class="card-header">
                                        <h3 class="card-title">Blog</h3>
                                    </div>

                                    <div class="card-body">
                                        @if (Session::has('errors'))
                                            <div class="alert alert-danger" role="alert" auto-close="3000">
                                                @foreach ($errors->all() as $error)
                                                    {{ $error }}<br />
                                                @endforeach
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label for="title">Blog Başlığı</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                id="title" name="title" placeholder="Blog Başlığı"
                                                {{ old('title') ? 'value=' . old('title') . '' : '' }}
                                                @isset($blogDuzenle) value="{{ $blogDuzenle->title }}"
                                                @endisset required>
                                        </div>


                                        <div class="form-group">
                                            <label for="body">İçerik</label>
                                            <textarea name="body" id="body" class="form-control" cols="30" rows="10">
                                                                {{ old('body') }} @isset($blogDuzenle){{ $blogDuzenle->body }}@endisset
                                                                            </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card card-primary card-outline card-tabs">
                                        <div class="card-header">
                                            <h3 class="card-title">Blog Özellikleri</h3>
                                        </div>

                                        <div class="card-body">
                                            <label>Blog Kapak Fotoğrafı</label>
                                            @if (isset($blogDuzenle) && $blogDuzenle->photo != null)
                                                <div class="form-group">
                                                    <img src="{{ $blogDuzenle->photo }}" class="photo_visible">
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input id="thumbnail"
                                                        {{ old('filepath') ? 'value=' . old('filepath') . '' : '' }}
                                                        @isset($blogDuzenle) value="{{ $blogDuzenle->photo }}"
                                                        @endisset class="form-control" type="text" name="filepath">
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
                                                <label for="slug">Seo Url</label><small> (<b>örn:</b>Blog yazısı)</small>
                                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                                    id="slug" name="slug"
                                                    {{ old('slug') ? 'value=' . old('slug') . '' : '' }}
                                                    @isset($blogDuzenle) value="{{ $blogDuzenle->slug }}"
                                                    @endisset placeholder="Seo Url" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="kategori">Kategori</label>
                                                <select name="kategori" id="kategori"
                                                    class="form-control @error('kategori') is-invalid @enderror" name="kategori"
                                                    id="kategori" required>
                                                    @foreach ($category as $data)
                                                        <option {{ old('kategori') ? 'selected' : '' }}
                                                            @isset($blogDuzenle) @if ($data->id === $blogDuzenle->category_id) selected @endif
                                                            @endisset value="{{ $data->id }}">
                                                            {{ $data->category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="anahtar">Anahtar Kelimeler</label>
                                                <textarea name='anahtar' id="anahtar" placeholder='Anahtar Kelimeler'>

                                                                        @if (old('anahtar') && isset($blogDuzenle))
                                                                        {{ old('anahtar') }}
                                                                @elseif (isset($blogDuzenle))
                                                                        {{ $blogDuzenle->etiketler }}
                                                                        @endif


                                                                                                            </textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="yayin">Yayın Durumu</label>
                                                <select class="form-control" name="yayin">

                                                    <option value="1" @isset($blogDuzenle)
                                                        @if ($blogDuzenle->status === '1') selected @endif @endisset
                                                        {{ old('yayin') == 1 ? 'selected' : '' }}>Açık</option>

                                                    <option value="0" @isset($blogDuzenle)
                                                        @if ($blogDuzenle->status === '0') selected @endif @endisset
                                                        {{ old('yayin') && old('yayin') == 0 ? 'selected' : '' }}>Kapalı
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group text-right">
                                                <input name="newblog" class="btn btn-success text-right" type="submit"
                                                    value="Kaydet">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </section>
        </div>

    @endsection
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
