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
            <div class="container-fluid ">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Kullanıcılar</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Kullanıcılar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid pb-2">
                <div class="row mb-3">
                    <div class="col-12"><a href="{{ route('admin.newuser') }}" class="btn btn-success">Yeni Kullanıcı
                            Ekle</a></div>
                </div>
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header">
                        <h3 class="card-title">Kullanıcılar</h3>
                    </div>

                    <div class="card-body">

                        <table id="users" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="50">Sıra</th>
                                    <th>Fotoğraf</th>
                                    <th>Adı Soyadı</th>
                                    <th>Rolü</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                        <tr id="remove_{{ $user->id }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img class="photo_visible" src="{{ Storage::url($user->photo) }}"></td>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                            @foreach ($user->roles  as $role )
                                                {{$role->name}}
                                            @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.user.edit', $user->id) }}"
                                                    class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                                                <a class="btn btn-sm btn-danger removeuser" id="{{ $user->id }}"><i
                                                        class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="50">Sıra</th>
                                    <th>Fotoğraf</th>
                                    <th>Adı Soyadı</th>
                                    <th>Rolü</th>
                                    <th></th>
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
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

            $('.removeuser').click(function() {
                var confirmText = "Bu kaydı silmek istediğinizden emin misiniz ?";
                var dataiddelete = $(this).attr("id");
                if (confirm(confirmText)) {
                    $.ajax({
                        type: "DELETE",
                        data: {
                            dataid: $(this).attr("id")
                        },
                        url: "kullanicilar/" + dataiddelete,
                        success: function(data) {
                            if (data == 'success') {
                                $("#remove_" + dataiddelete).remove();
                            }
                        },
                    });
                }
                return false;
            });
        });
    </script>
@endsection
