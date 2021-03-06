@extends('backend.app')

@section('cssAdd')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .photo_visible {
            max-width: 200px;
            max-height: 200px;
            height: auto;
            width: auto;
        }

        .image-area {
            position: relative;
            width: auto;
            height: auto;
            max-width: 200px;
            max-height: 200px;
        }

        .image-area img {
            max-width: 100%;
            height: 200px;
        }

        .remove-image {
            display: none;
            position: absolute;
            top: -20px;
            right: -20px;
            border-radius: 10em;
            padding: 2px 6px 3px;
            text-decoration: none;
            font: 600 18px/18px sans-serif;
            background: #555;
            border: 1px solid #fff;
            color: #FFF;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5), inset 0 2px 4px rgba(0, 0, 0, 0.3);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
            -webkit-transition: background 0.5s;
            transition: background 0.5s;
        }

        .remove-image:hover {
            background: #E54E4E;
            padding: 3px 7px 5px;
            top: -21px;
            right: -21px;
        }

        .remove-image:active {
            background: #E54E4E;
            top: -21px;
            right: -21px;
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
                        <h1>Sayfa Özellikleri</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Sayfa Özellikleri</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        @role('Admin')
            <section class="content">
                <div class="container-fluid">
                    <div class="row" class="">
                        <div class="col-12 ">
                            <div class=" card card-outline card-primary ">
                                <div class="card-header">Yeni Bölüm Ekle</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('admin.page.store') }}" multiple
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('post')
                                        <input type="hidden" name="pageid" value="{{ $id }}">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-2 col-md-2 col-sm-4">
                                                <input type="text"
                                                    class="form-control @error('description') is-invalid @enderror"
                                                    name="description" placeholder="Açıklama">
                                                @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-4">
                                                <input type="text" class="form-control @error('key') is-invalid @enderror"
                                                    name="key" placeholder="Kısa Kod">
                                                @error('key')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-4">
                                                <input type="text" class="form-control @error('value') is-invalid @enderror"
                                                    name="value" placeholder="Değeri">
                                                @error('value')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-4">
                                                <select class="form-control @error('dosya_tipi') is-invalid @enderror"
                                                    name="dosya_tipi">
                                                    <option value="text">Text</option>
                                                    <option value="textarea">Textarea</option>
                                                    <option value="ckeditor">Ckeditor</option>
                                                    <option value="image">Resim</option>
                                                </select>
                                                @error('dosya_tipi')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-4">
                                                <select class="form-control @error('sil') is-invalid @enderror" name="sil">
                                                    <option value="1" selected>Silinebilir</option>
                                                    <option value="0">Silinemez</option>
                                                </select>
                                                @error('sil')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-4 text-center">
                                                <input type="submit" class="btn btn-primary" name="newPageSettings"
                                                    value="Kaydet">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        @endrole
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel"
                                aria-labelledby="custom-tabs-three-home-tab">
                                <form action="{{ route('admin.page.store') }}" method="POST"
                                    enctype='multipart/form-data'>
                                    @csrf
                                    <div id="site" class="list-group">
                                        @foreach ($pageData as $key => $value)
                                            <div class="row list-group-item" id="removeDiv_{{ $value->id }}">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12 mt-3 ">
                                                            <label>{{ $value->feature_description }} <small
                                                                    class="text-danger">$page->{{ltrim(strpbrk($value->feature_key, "." ),'. ')}}</small></label>
                                                        </div>
                                                        <div class="col-12 align-self-center mt-1">
                                                            <div class="row">
                                                                <div class="col-11">
                                                                    @if ($value->feature_type == 'image')
                                                                        <div class="row mt-2 mb-2 m-2">
                                                                            <div class="col-12">
                                                                                <div class="image-area">
                                                                                    <img src="{{ Storage::url($value->feature_value) }}"
                                                                                        name="{{ $value->feature_key }}"
                                                                                        id="remove_image_{{ $value->id }}">
                                                                                    <button role="button" type="button"
                                                                                        id="{{ $value->id }}"
                                                                                        data-value="{{ $value->feature_value }}"
                                                                                        class="remove-image"
                                                                                        style="display: inline;">&#215;</button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <input type="file"
                                                                                name="image[{{ $value->id }}]" class="form-control"
                                                                                value="{{ $value->feature_value }}" class="mt-2">
                                                                            </div>

                                                                        </div>
                                                                    @elseif ($value->feature_type=='text')
                                                                        <input type="text" name="{{ $value->id }}"
                                                                            class="form-control"
                                                                            value="{{ $value->feature_value }}">
                                                                    @elseif ($value->feature_type=='ckeditor')
                                                                        <textarea name="{{ $value->id }}"
                                                                            id="{{ $value->id }}" class="editor"
                                                                            style="min-height: 300px;">{{ $value->feature_value }}</textarea>
                                                                    @elseif ($value->feature_type=='textarea')
                                                                        <textarea class="form-control"
                                                                            name="{{ $value->id }}" rows="5"
                                                                            cols="200">{{ $value->feature_value }}</textarea>
                                                                    @endif
                                                                </div>
                                                                <div class="col-1 align-self-center">
                                                                    @if ($value->feature_delete == 1)
                                                                        <a id='{{ $value->id }}'
                                                                            href="javascript:void(0)" style="color:#e74141"
                                                                            class="fas fa-trash sil_btn"></a>
                                                                    @endif
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 text-right">

                                            <button type="submit" class="btn btn-success"
                                                name="allFeatureData">Kaydet</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <p>
                                    Tüm verileri silmeniz halinde yaptığınız işlemi geri alamayacaksınız
                                </p>
                            </div>
                            <div class="col-6 text-right">
                                <a class="btn btn-danger deleteAllFeature" id='{{ $id }}'>Tüm
                                    Verileri Sil</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
@section('scriptAdd')
    <script src="https://cdn.ckeditor.com/4.16.1/standard-all/ckeditor.js"></script>
    <script src="/backend/plugins/sortable/sortable.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('.sil_btn').click(function() {
                var confirmText = "Bu veriyi silmek istediğinizden emin misiniz ?";
                var dataiddelete = $(this).attr("id");
                if (confirm(confirmText)) {
                    $.ajax({
                        type: "POST",
                        data: {
                            dataid: $(this).attr("id"),
                        },
                        url: '{{ route('featureDelete') }}',
                        success: function(data) {
                            console.log(data);
                            if (data == 'success') {
                                $("#removeDiv_" + dataiddelete).remove();
                            }
                        },
                    });
                }
                return false;
            });

            $('.remove-image').click(function() {
                var confirmText = "Bu dosyayı silmek istediğinizden emin misiniz ?";
                var dataiddelete = $(this).attr("id");
                if (confirm(confirmText)) {
                    $.ajax({
                        type: "POST",
                        data: {
                            dataid: $(this).attr("id"),
                            datavalue: $(this).attr("data-value")
                        },
                        url: '{{ route('featureDeleteImage') }}',
                        success: function(data) {
                            console.log(data);
                            if (data == 'success') {
                                $("#remove_image_" + dataiddelete).remove();
                            }
                        },
                    });
                }
                return false;
            });

            $('.deleteAllFeature').click(function() {
                var confirmText =
                    "Tüm verileri silmek istediğinizden emin misiniz, yaptığınız işlem geri alınmayacaktır ?";
                var dataiddelete = $(this).attr("id");
                if (confirm(confirmText)) {
                    $.ajax({
                        type: "POST",
                        data: {
                            dataid: $(this).attr("id"),
                        },
                        url: '{{ route('deleteAllFeature') }}',
                        success: function(data) {
                            console.log(data);
                            if (data == 'success') {
                                location.reload();
                            }
                        },
                    });
                }
                return false;
            });

            $(".editor").each(function() {
                let id = $(this).attr('id');
                CKEDITOR.replace(id, {
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
                            items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight',
                                'JustifyBlock'
                            ]
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
                            items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent',
                                '-',
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

                    // Adding drag and drop image upload.
                    extraPlugins: 'print,format,font,colorbutton,justify,uploadimage',
                    uploadUrl: '/apps/ckfinder/3.4.5/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

                    // Configure your file manager integration. This example uses CKFinder 3 for PHP.
                    filebrowserImageBrowseUrl: '/admin/filemanager?type=Images',
                    filebrowserImageUploadUrl: '/admin/filemanager/upload?type=Images&_token={{ csrf_token() }}',
                    filebrowserBrowseUrl: '/admin/filemanager?type=Files',
                    filebrowserUploadUrl: '/admin/filemanager/upload?type=Files&_token={{ csrf_token() }}',

                    height: 200,

                    removeDialogTabs: 'image:advanced;link:advanced',
                    language: 'tr'
                });
            });
        });
    </script>
    <script src="/backend/plugins/js/jquery-ui.min.js"></script>

    <script>

    </script>
@endsection
