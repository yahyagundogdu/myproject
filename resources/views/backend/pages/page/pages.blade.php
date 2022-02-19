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
                            <li class="breadcrumb-item active">Sayfalar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">

                <div class="row mb-3">
                    <div class="col-12">
                        <a href="{{ route('admin.newPage') }}" class="btn btn-success mr-2"><i class="far fa-sticky-note mr-1"></i> Yeni Sayfa Ekle</a>
                        <a href="{{ route('sortablePages') }}" class="btn btn-info mr-2"><i class="fas fa-sort-amount-down mr-1"></i> Sırala</a>
                        <a href="{{ route('modules') }}" class="btn btn-warning"><i class="far fa-clone mr-1"></i>Modüller</a>
                    </div>
                </div>
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header">
                        <h3 class="card-title">Sayfalar</h3>
                    </div>

                    <div class="card-body">

                        <table id="slides" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th width="50">Sıra</th>
                                    <th>Adı</th>
                                    <th>Slug</th>
                                    <th width="300"></th>
                                </tr>
                            </thead>
                            <tbody id="slidessortable">
                                @foreach ($pages as $data)
                                    @php
                                        $id = $data->id;
                                    @endphp
                                    @if ($data->sub_page_id == null)
                                        <tr id="remove_{{ $data->id }}" data-id="{{ $data->id }}"
                                            name="{{ $data->id }}" >

                                            <td>
                                                {{ $loopData = $loop->iteration }}
                                            </td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->slug }}</td>
                                            <td>
                                                <a href="{{ route('admin.page.show', $data->id) }}"
                                                    class="btn btn-sm btn-dark"><i class="far fa-edit"></i> Sayfa
                                                    Düzenle</a>
                                                <a href="{{ route('admin.page.edit', $data->id) }}"
                                                    class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                                                <a class="btn btn-sm btn-danger removedata" id="{{ $data->id }}"><i
                                                        class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                    @php
                                        $value = $data->children($id);
                                    @endphp
                                    @if ($value)
                                        @foreach ($value as $child)
                                            <tr class="{{ $child->active == 1 ? 'table-success' : 'table-danger' }}"
                                                id="remove_{{ $child->id }}" data-id="{{ $id . '.' . $child->id }}"
                                                name="{{ $child->id }}">
                                                <td>{{ $loopData . '.' . $loop->iteration }}
                                                </td>
                                                <td> <i class="fas fa-level-up-alt fa-rotate-90 pr-1 pl-3 fa-sm"></i>
                                                    {{ $child->name }}
                                                </td>
                                                <td>{{ $child->slug }}</td>
                                                <td>
                                                    <a href="{{ route('admin.page.show', $child->id) }}"
                                                        class="btn btn-sm btn-dark"><i class="far fa-edit"></i> Sayfa
                                                        Düzenle</a>
                                                    <a href="{{ route('admin.page.edit', $child->id) }}"
                                                        class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                                                    <a class="btn btn-sm btn-danger removedata" id="{{ $child->id }}"><i
                                                            class="far fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="50">Sıra</th>
                                    <th>Adı</th>
                                    <th>Slug</th>
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
                        url: 'pages/sortablesettings',
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
