@extends('backend.app')

@section('cssAdd')
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
    <link rel="stylesheet" href="/backend/plugins/css/jquery-ui.min.css">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Slider</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Slider</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col-12"><a href="{{route('admin.newSlider')}}" class="btn btn-success">Yeni Slayt Ekle</a></div>
                </div>
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header">
                        <h3 class="card-title">Slaytlar</h3>
                    </div>

                    <div class="card-body">

                        <table id="slides" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="50">Sıra</th>
                                    <th>Fotoğraf</th>
                                    <th>Başlık</th>
                                    <th>Alt Başlık</th>
                                    <th width="70"></th>
                                </tr>
                            </thead>
                            <tbody id="slidessortable">
                                @foreach ($slider as $data)
                                    <tr id="remove_{{ $data->id }}" data-id="{{ $data->id }}" name="{{ $data->id }}">
                                        <td><i class="fas fa-arrows-alt" style="cursor:move"></i> {{ $loop->iteration }}</td>
                                        <td><img class="photo_visible" src="{{ $data->photo }}"></td>
                                        <td>{{ $data->title }}</td>
                                        <td>{!!Str::limit($data->subtext,150)!!}</td>
                                        <td>
                                            <a href="{{ route('admin.slider.edit', $data->id) }}"
                                                class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger removeuser" id="{{ $data->id }}"><i
                                                    class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="50">Sıra</th>
                                    <th>Fotoğraf</th>
                                    <th>Başlık</th>
                                    <th>Alt Başlık</th>
                                    <th width="70"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
@section('scriptAdd')
<script src="/backend/plugins/sortable/sortable.min.js"></script>
    @include('backend.include.datatable.datatableScriptModule')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#slides").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('.removeuser').click(function() {
                var confirmText = "Bu kaydı silmek istediğinizden emin misiniz ?";
                var dataiddelete = $(this).attr("id");
                if (confirm(confirmText)) {
                    $.ajax({
                        type: "DELETE",
                        data: {
                            dataid: $(this).attr("id")
                        },
                        url: "slider/" + dataiddelete,
                        success: function(data) {
                            if (data == 'success') {
                                $("#remove_" + dataiddelete).remove();
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
            new Sortable(slidessortable, {
                handle: '.fa-arrows-alt',
                animation: 150,
                ghostClass: 'blue-background-class',
                onUpdate: function(evt) {
                    var sonsiralama = [];
                    var siralama = evt.to.children;
                    for (var i = 0; i < siralama.length; i++) {
                        sonsiralama[i] = siralama[i].id;
                    }

                    $.ajax({
                        type: "POST",
                        url: 'slider/sortablesettings',
                        data: {
                            data: sonsiralama
                        },
                        success: function(data) {
                            console.log(data);
                        },
                    });
                },
            });
        });


    </script>
    <script src="/backend/plugins/js/jquery-ui.min.js"></script>
@endsection
