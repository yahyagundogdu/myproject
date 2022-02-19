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
    @include('backend.include.datatable.datatableCssModule')
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Modül Veri Ekle</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Modül Veri Ekle</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>


        @if (Session::has('error'))
            <script>
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                Toast.fire({
                    icon: 'error',
                    title: {{ session('error') }}
                });
            </script>
        @elseif (Session::has('success'))
            <script>
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                Toast.fire({
                    icon: 'success',
                    title: {{ session('success') }}
                });
            </script>
        @endif

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('module-data.store') }}" method="post">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Yeni Veri Ekle</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>


                        <div class="modal-body">
                            @foreach ($module_body as $value)
                                @php
                                    $modul_data = json_decode($value->module_form);
                                @endphp
                                <div class="form-group">
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <label for="name">{{ $modul_data->module_description }}</label>
                                    @if ($modul_data->module_type == 'text')
                                        <input type="text" class="form-control" id="name" name="data[][text][value]">
                                    @elseif ($modul_data->module_type == 'image')
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input id="thumbnail" class="form-control" type="text"
                                                    name="data[][image][value]">
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
                                    @elseif ($modul_data->module_type == 'ckeditor')
                                        <textarea name="data[][ckeditor][value] editor" id="{{ $value->id }}"
                                            class="form-control editor" cols="50" rows="10"></textarea>
                                    @elseif ($modul_data->module_type == 'textarea')
                                        <textarea name="data[][textarea][value]" class="form-control" cols="50"
                                            rows="10"></textarea>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button role="button" type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12">
                        <a href="{{ route('modules') }}" class="btn btn-warning">Modüller</a>
                        <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#modal-default">
                            <i class="far fa-sticky-note mr-1"></i> Yeni Veri Ekle
                        </button>
                    </div>
                </div>
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-body">
                        <table id="module" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th width="50">Sıra</th>
                                    @foreach ($module_body as $module_first)
                                        @php
                                            $module_first = json_decode($module_first->module_form, true);
                                        @endphp
                                        @foreach ($module_first as $key => $module_row)
                                            @if ($key == 'module_description')
                                                <th>{{ $module_row }}</th>
                                            @endif
                                        @endforeach
                                    @endforeach

                                    <th width="300"></th>
                                </tr>
                            </thead>
                            <tbody id="slidessortable">
                                @foreach ($module_data as $modul)
                                    <tr id="remove_{{ $modul->id }}" modul-id="{{ $modul->id }}"
                                        name="{{ $modul->id }}">

                                        <td>
                                            {{ $loopData = $loop->iteration }}
                                        </td>

                                        @php
                                            $module_part = json_decode($modul->data, true);
                                        @endphp
                                        @foreach ($module_part as $value)
                                            @if ($value['data_type'] == 'image')
                                                <td>
                                                    <img src="{{ $value['data_value'] }}" class="photo_visible">
                                                </td>
                                            @elseif ($value['data_type']==='ckeditor')

                                                <td>
                                                    <div class="text"
                                                        style="overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1; /* number of lines to show */-webkit-box-orient: vertical;">
                                                        {!! $value['data_value'] !!}
                                                    </div>

                                                </td>
                                            @elseif ($value['data_type']==='textarea')
                                                <td>
                                                    {!! Str::limit($value['data_value'], 100) !!}
                                                </td>
                                            @else
                                                <td>{{ $value['data_value'] }}</td>
                                            @endif
                                        @endforeach
                                        <td>
                                            <a href="{{ route('module-edit', $modul->id) }}"
                                                class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger removedata"
                                                href="{{ route('module-delete', $modul->id) }}"
                                                id="{{ $modul->id }}"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>



@endsection
@section('scriptAdd')
    @include('backend.include.datatable.datatableScriptModule')
    <script src="https://cdn.ckeditor.com/4.16.1/standard-all/ckeditor.js"></script>
    <script src="/backend/plugins/sortable/sortable.min.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
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

            $("#module").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": 100
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


            $('.sil_btn').click(function() {
                var confirmText = "Bu satırı silmek istediğinizden emin misiniz ?";
                var dataiddelete = $(this).attr("id");
                if (confirm(confirmText)) {
                    $.ajax({
                        type: "POST",
                        data: {
                            dataid: $(this).attr("id")
                        },
                        url: '{{ route('deleteModuleItem') }}',
                        success: function(data) {
                            console.log(data);
                            if (data == 'success') {
                                $(".delete-item-" + dataiddelete).remove();
                            } else if (data == 'error') {
                                alert('Veri Silinemedi')
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
