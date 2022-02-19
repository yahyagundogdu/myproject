@extends('backend.app')
@section('cssAdd')
    @include('backend.include.datatable.datatableCssModule')
    <link rel="stylesheet" href="/backend/plugins/css/jquery-ui.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Kategoriler</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Kategoriler</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col-12">
                        <a href="{{ route('admin.category.create') }}" class="btn btn-success mb-2">Yeni Kategori Ekle</a>
                    </div>
                </div>
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header">
                        <h3 class="card-title">Kategoriler</h3>
                    </div>

                    <div class="card-body">

                        <table id="users" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="50">Sıra</th>
                                    <th>Kategori</th>
                                    <th width="70"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $data)
                                    <tr id='remove_{{$data->id}}'>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->category_name }}</td>
                                        <td>
                                            <a href="kategori/{{$data->id}}/edit" class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger removerole" id="{{$data->id}}"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="50">Sıra</th>
                                    <th>Kategori</th>
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
            $("#users").DataTable({
                "language": {
                    "lengthMenu": "Sayfa başına _MENU_ kayıt görüntüleyin",
                    "zeroRecords": "Nothing found - sorry",
                    "info": " _PAGE_ of _PAGES_",
                    "infoEmpty": "Kayıt Bulunamadı",
                    "infoFiltered": "(Arama sonuçlarından _MAX_ veri listelendi)",
                    "search": "Arama:",
                    "previous": "Önceki",
                    "next": "Sonraki",
                },
                "responsive": true,
                "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.removerole').click(function() {
                var confirmText = "Bu kaydı silmek istediğinizden emin misiniz ?";
                var dataiddelete = $(this).attr("id");
                if (confirm(confirmText)) {
                    $.ajax({
                        type: "DELETE",
                        data: {
                            dataid: $(this).attr("id"),
                            datavalue: $(this).attr("data-value")
                        },
                        url:"kategori/"+dataiddelete,
                        success: function(data) {
                            console.log(data);
                            if (data == 'success') {
                                $("#remove_" + dataiddelete).remove();
                            }
                            else if (data == 'error') {
                                alert('Bu kategori blog oluştururken kullanıldığından silemezsiniz!')
                            }
                        },
                    });
                }
                return false;
            });
        });
    </script>
@endsection
