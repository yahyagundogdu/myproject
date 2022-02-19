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
            height: auto;
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
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Modül Yapısı Oluşturucu</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Modül Yapısı Oluşturucu</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-12">
                        <a href="{{ route('moduleData.show', $modul->module_id) }}" class="btn btn-warning">Geri Dön</a>
                    </div>
                </div>
                <div class="card card-primary card-outline card-tabs">
                    <form action="{{ route('module-update', $id) }}" method="post">
                        @method('post')
                        @csrf
                        <div class="card-body">
                            @php
                                $array_data = json_decode($modul->data, true);
                            @endphp
                            @foreach ($array_data as $key => $value)



                                <div class="form-group">
                                    <label for="{{ $id }}">
                                        @php
                                            $title = json_decode($module_body[$key]['module_form'], true);
                                        @endphp
                                        {{ $title['module_description'] }}
                                    </label>
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    @if ($value['data_type'] == 'text')
                                        <input type="text" class="form-control" id="name" name="data[][text][value]"
                                            value="{{ $value['data_value'] }}">
                                    @endif
                                    @if ($value['data_type'] == 'image')
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input id="thumbnail" class="form-control" type="text"
                                                    name="data[][image][value]" value="{{ $value['data_value'] }}">
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
                                    @endif
                                    @if ($value['data_type'] == 'textarea')
                                        <textarea name="data[][textarea][value]" class="form-control" cols="50"
                                            rows="10">{{ $value['data_value'] }}</textarea>
                                    @endif
                                    @if ($value['data_type'] == 'ckeditor')
                                        <textarea name="data[][ckeditor][value] editor"
                                            id="{{ $loopData = $loop->iteration }}" class="form-control editor" cols="50"
                                            rows="10">{{ $value['data_value'] }}</textarea>
                                    @endif
                                </div>

                            @endforeach
                            <div class="justify-content-between">
                                <button type="submit" class="btn btn-primary">Kaydet</button>
                            </div>
                    </form>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection
@section('scriptAdd')
    <script src="https://cdn.ckeditor.com/4.16.1/standard-all/ckeditor.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="/backend/plugins/sortable/sortable.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#lfm').filemanager('image');
            $('#remove-image').click(function() {
                $('#thumbnail').val("");
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
