@extends('backend.app')

@section('cssAdd')
    <link href="/frontend/fileupload/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/frontend/fileupload/themes/explorer-fas/theme.css" media="all" rel="stylesheet" type="text/css" />
    <script src="/frontend/fileupload/js/plugins/piexif.js" type="text/javascript"></script>
    <script src="/frontend/fileupload/js/plugins/sortable.js" type="text/javascript"></script>
    <script src="/frontend/fileupload/js/fileinput.js" type="text/javascript"></script>
    <script src="/frontend/fileupload/js/locales/tr.js" type="text/javascript"></script>
    <script src="/frontend/fileupload/themes/fas/theme.js" type="text/javascript"></script>
    <script src="/frontend/fileupload/themes/explorer-fas/theme.js" type="text/javascript"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('backend.include.datatable.datatableCssModule')

    <style>
        .photo_visible {
            max-width: 100px;
            max-height: 100px;
            height: auto;
            width: auto;
        }

    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/backend/plugins/css/jquery-ui.min.css">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ürünler</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Ürünler</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="card card-outline card-danger">
                            <div class="card-header">
                                Galeri
                            </div>
                            <div class="card-content mx-3 my-3 mb-2">
                                <label>Kapak Fotoğrafı</label>
                                <div class="file-loading">
                                    <input id="file-tr" name="file-tr[]" type="file">
                                </div>
                                <label>Galeri</label>
                                <div class="file-loading">
                                    <input id="file-tr-1" name="file-tr[]" type="file" multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                Ürün İşlemleri
                            </div>
                            <div class="card-content mx-4 mt-1">
                                <div class="form-group">
                                    <label for="name">Adı</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Başlık" @if (!isset($sayfaDuzenle)) value="{{ old('name') ? old('name') : '' }}" @endif
                                        @isset($sayfaDuzenle) value="{{ $sayfaDuzenle->name }}"
                                        @endisset required>
                                </div>
                                <div class="form-group">
                                    <label for="category">Kategori</label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="0">Kategori</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="slug">Seo Url</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        id="slug" name="slug" placeholder="Seo Url" @if (!isset($sayfaDuzenle)) value="{{ old('slug') ? old('slug') : '' }}" @endif
                                        @isset($sayfaDuzenle) value="{{ $sayfaDuzenle->slug }}"
                                        @endisset required>
                                </div>
                                <div class="form-group">
                                    <label for="body">İçerik</label>
                                    <textarea name="body" id="body" class="form-control" cols="30"
                                        rows="10">@isset($blogDuzenle){{ $blogDuzenle->body }}@endisset</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    Varyasyon Seçenekleri
                                </div>
                                <div class="card-content mx-4 mt-1">
                                    <p>Test</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    @endsection
@section('scriptAdd')
    <script src="https://cdn.ckeditor.com/4.16.1/standard-all/ckeditor.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    @include('backend.include.datatable.datatableScriptModule')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#file-tr').fileinput({
                theme: 'fas',
                language: 'tr',
                allowedFileExtensions: ['jpg', 'png', 'gif'],
                showUpload: false,
                showCaption: false,
            });

            $('#file-tr-1').fileinput({
                theme: 'fas',
                language: 'tr',
                allowedFileExtensions: ['jpg', 'png', 'gif'],
                showUpload: false,
                showCaption: false,
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

            $("#slides").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": 100
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('.removedata').click(function() {
                var confirmText = "Bu kaydı silmek istediğinizden emin misiniz ?";
                var dataiddelete = $(this).attr("id");
                if (confirm(confirmText)) {
                    $.ajax({
                        type: "DELETE",
                        data: {
                            dataid: $(this).attr("id")
                        },
                        url: "sayfalar/" + dataiddelete,
                        success: function(data) {
                            if (data == 'success') {
                                $("#remove_" + dataiddelete).remove();
                            } else if (data == 'error') {
                                alert('Bu sayfa kullanıldığından silemezsiniz')
                            }
                        },
                    });
                }
                return false;
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    <script src="/backend/plugins/js/jquery-ui.min.js"></script>
@endsection
