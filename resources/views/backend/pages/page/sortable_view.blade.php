@extends('backend.app')

@section('cssAdd')
    @include('backend.include.datatable.datatableCssModule')

    <style>
        .photo_visible {
            max-width: 500px;
            max-height: 500px;
            height: auto;
            width: auto;
        }

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css"
        integrity="sha512-yOW3WV01iPnrQrlHYlpnfVooIAQl/hujmnCmiM3+u8F/6cCgA3BdFjqQfu8XaOtPilD/yYBJR3Io4PO8QUQKWA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/backend/plugins/css/jquery-ui.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sayfa Sırala</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Sayfa Sırala</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-12">
                        <a href="{{ route('admin.page') }}" class="btn btn-success mr-2">Sayfalar</a>
                    </div>
                </div>
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header">
                        <h3 class="card-title">Sayfa Sırala</h3>
                    </div>

                    <div class="card-body">
                        <div class="dd">
                            <ol class="dd-list">
                                @foreach ($pages as $data)
                                    @php
                                        $id = $data->id;
                                    @endphp
                                    @if ($data->sub_page_id == null)

                                        <li class="dd-item" data-id="{{ $data->id }}">
                                            <div class="dd-handle">
                                                {{ $data->name }}
                                            </div>
                                            @php
                                                $value = $data->children($id);
                                            @endphp
                                            @if ($value && count($value) > 0)
                                                <ol class="dd-list">
                                                    @foreach ($value as $child)
                                                        <li class="dd-item" data-id="{{ $child->id }}">
                                                            <div class="dd-handle">
                                                                {{ $child->name }}
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ol>
                                            @endif

                                        </li>

                                    @endif

                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scriptAdd')
@section('scriptAdd')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"
        integrity="sha512-7bS2beHr26eBtIOb/82sgllyFc1qMsDcOOkGK3NLrZ34yTbZX8uJi5sE0NNDYFNflwx1TtnDKkEq+k2DCGfb5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.dd').nestable({
                callback: function(l,e, p) {
                    var deger = $('.dd').nestable('serialize');
                    console.log(deger);
                    $.ajax({
                        type: "POST",
                        url: 'siralmakayit',
                        data: {
                            data: deger
                        },
                        success: function(data) {
                            if(data=='sucess'){
                                alert('işlem başarılı');
                            }
                            console.log(data);
                        },
                    });
                }
            });


        });
    </script>
@endsection
