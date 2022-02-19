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

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sayfalar</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Modüller</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container">

                <div class="row mb-3">
                    <div class="col-12">
                        @role('Admin')
                        <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#modal-default">
                            <i class="far fa-sticky-note mr-1"></i> Yeni Modül Ekle
                        </button>
                        @endrole
                        <a href="{{ route('admin.page') }}" class="btn btn-primary mr-2"><i
                                class="far fa-file mr-1"></i>Sayfalar</a>
                    </div>
                </div>
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header">
                        <h3 class="card-title">Modüller</h3>
                    </div>

                    <div class="card-body">
                        <table id="slides" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th width="50">Sıra</th>
                                    <th>Modül Adı</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="slidessortable">
                                @foreach ( $modules as $data)
                                <tr>
                                    <td>{{ $loopData = $loop->iteration }}</td>
                                    <td>{{$data->module_name}}</td>
                                    <td>
                                        @role('Admin')
                                        <a href="{{route('moduleBody.show', $data->id)}}" class="btn btn-sm btn-secondary"><i class="fab fa-wpforms mr-1"></i> Modül Yapısı</a>
                                        @endrole
                                        <a href="{{route('moduleData.show',$data->id)}}" class="btn btn-sm btn-success"><i class="fas fa-box mr-1"></i> Modülü Görüntüle</a>
                                        <a href="{{route('module-name-edit',$data->id)}}" name="modulDuzenle"  class="btn btn-sm btn-primary"><i class="far fa-trash-alt mr-1"></i> Düzenle</a>
                                        <button class="btn btn-sm btn-danger"><i class="far fa-trash-alt mr-1"></i> Sil</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="50">Sıra</th>
                                    <th>Modül Adı</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('modules.create')}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Yeni Modul Ekle</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Modül Adı</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Modül Adını Yazınız">
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button role="button" type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
    <div class="modal fade" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Modul Düzenle</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Modül Adı</label>
                            <input type="text" class="form-control" id="edit-name" name="name" placeholder="Modül Adını Yazınız">
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button role="button" type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>

        </div>

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
