@extends('backend.app')

@section('cssAdd')
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
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Bloglar</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Bloglar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col-12"><a href="{{ route('admin.newBlog') }}" class="btn btn-success">Yeni Blog
                            Ekle</a></div>
                </div>
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header">
                        <h3 class="card-title">Bloglar</h3>
                    </div>

                    <div class="card-body">

                        <table id="users" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="50">Sıra</th>
                                    <th>Kapat Fotoğrafı</th>
                                    <th>Başlık</th>
                                    <th>Etiketler</th>
                                    <th>Kategori</th>
                                    <th>Yayın</th>
                                    <th>Görüntülenme Sayısı</th>
                                    <th>Tarih</th>
                                    <th width="70"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blog as $data)
                                    <tr id="remove_{{ $data->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img class="photo_visible" src="{{ $data->photo }}"></td>
                                        <td>{{ $data->title }}</td>
                                        <td>
                                            @if ($data->etiketler && $data->etiketler != null)
                                                @php
                                                    $data_arr = json_decode($data->etiketler, true);
                                                @endphp
                                                @foreach ($data_arr as $value)
                                                    <span class="badge badge-dark">{{ $value }}</span>
                                                @endforeach
                                            @else
                                            @endif
                                        </td>

                                        <td>{{ $data->getcategory->category_name ? $data->getcategory->category_name : 'null' }}
                                        </td>
                                        <td>{{ $data->status==1?'Yayında':'Yayında Değil' }}</td>
                                        <td>{{ $data->viewer_count }}</td>
                                        <td>{{ $data->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.blog.edit', $data->id) }}"
                                                class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger removedata" id="{{ $data->id }}"><i
                                                    class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="50">Sıra</th>
                                    <th>Kapat Fotoğrafı</th>
                                    <th>Başlık</th>
                                    <th>Etiketler</th>
                                    <th>Kategori</th>
                                    <th>Yayın</th>
                                    <th>Görüntülenme Sayısı</th>
                                    <th>Tarih</th>
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
    @include('backend.include.datatable.datatableScriptModule')
    <script>
        $(function() {
            $("#users").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.removedata').click(function() {
                var confirmText = "Bu kaydı silmek istediğinizden emin misiniz ?";
                var dataiddelete = $(this).attr("id");
                if (confirm(confirmText)) {
                    $.ajax({
                        type: "post",
                        data: {
                            dataid: $(this).attr("id")
                        },
                        url: "{{ route('removeBlog') }}",
                        success: function(data) {
                            if (data == 'success') {
                                $("#remove_" + dataiddelete).remove();
                            }else{
                                swal('error','Hata Bu veri silinemedi')
                            }
                        },
                    });
                }
                return false;
            });
        });
    </script>
@endsection
