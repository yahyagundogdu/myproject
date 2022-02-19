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
                        <a href="{{route('modules')}}" class="btn btn-warning">Modüller</a>
                    </div>
                </div>
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-body">
                        <div>
                            <form action="{{ route('settings.store') }}" method="POST" enctype='multipart/form-data'>
                                @csrf
                                <div id="modul" id="modul">
                                @foreach ($module_body as $modul)
                                        <div class="row list-group-item delete-item-{{ $modul->id }}" id="{{ $modul->id }}">
                                            <div class="col-auto d-flex align-items-center">
                                                <i class="fas fa-arrows-alt" style="cursor:move"></i>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    @php
                                                        $data_decode = json_decode($modul->module_form);
                                                    @endphp
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-11">
                                                                <input type="text" class="form-control m-2"
                                                                    name="module_description"
                                                                    value="{{ $data_decode->module_description }}">
                                                                <select class="form-control m-2" name="module_type"
                                                                    disabled>
                                                                    <option
                                                                        {{ $data_decode->module_type == 'text' ? 'selected' : '' }}
                                                                        value="text">Text</option>
                                                                    <option
                                                                        {{ $data_decode->module_type == 'textarea' ? 'selected' : '' }}
                                                                        value="textarea">Textarea</option>
                                                                    <option
                                                                        {{ $data_decode->module_type == 'ckeditor' ? 'selected' : '' }}
                                                                        value="ckeditor">Ckeditor</option>
                                                                    <option
                                                                        {{ $data_decode->module_type == 'image' ? 'selected' : '' }}
                                                                        value="image">Resim</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-1 d-flex align-items-center">
                                                                <div class="col-1 align-self-center">
                                                                    <a id="{{ $modul->id }}"
                                                                        style="color:#808080"
                                                                        class="fas fa-trash sil_btn"></a>
                                                                </div>
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
                                        <button type="submit" class="btn btn-success" name="module">Kaydet</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container">
                <div class="row" class="">
                    <div class=" col-12 ">
                                <div class="   card card-outline card-primary ">
                    <div class="card-header">Modül Yapısı Oluşturucu</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('moduleBody.create') }}"
                            class="">
                        @csrf
                        @method('post')

                            <div class="
                            row d-flex justify-content-center">
                            <div class="col-lg-2 col-md-2 col-sm-4 mt-1">
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="text" class="form-control @error('description') is-invalid @enderror"
                                    name="description" placeholder="Açıklama">
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-4 mt-1">
                                <select class="form-control @error('dosya_tipi') is-invalid @enderror"
                                    name="module_element_type">
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
                            <div class="col-lg-2 col-md-2 col-sm-4 text-center mt-1">
                                <input type="submit" class="btn btn-primary" name="yeniayar" value="Kaydet">
                            </div>
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
    <script src="https://cdn.ckeditor.com/4.16.1/standard-all/ckeditor.js"></script>
    <script src="/backend/plugins/sortable/sortable.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            new Sortable(modul, {
                handle: '.fa-arrows-alt',
                animation: 150,
                ghostClass: 'blue-background-class',
                onUpdate: function(evt) {
                    console.log(evt.to.children)
                    var sonsiralama = [];
                    var siralama = evt.to.children;
                    for (var i = 0; i < siralama.length; i++) {
                        sonsiralama[i] = siralama[i].id;
                    }
                    $.ajax({
                        type: "POST",
                        url: '{{ route('moduleSortable') }}',
                        data: {
                            data: sonsiralama
                        },
                        success: function(data) {
                            console.log(data);
                        },
                    });
                },
            });

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
                            }else if(data == 'error'){
                                alert('Veri Silinemedi')
                            }
                        },
                    });
                }
                return false;
            });

        });
    </script>
    <script src="/backend/plugins/js/jquery-ui.min.js"></script>

    <script>

    </script>
@endsection
