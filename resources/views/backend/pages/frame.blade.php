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
                    <h1>Admin Paneli</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Ana Sayfa</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">

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
