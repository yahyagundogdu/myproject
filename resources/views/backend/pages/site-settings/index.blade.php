@extends('backend.app')

@section('cssAdd')
    <style>
        .photo_visible {
            max-width: 500px;
            max-height: 500px;
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
                        <h1>Sayfa İşlemleri</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Sayfa İşlemleri</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header">
                        <h3 class="card-title">Site Ayarları</h3>
                    </div>
                    <div class="card-body d-flex">
                        <form action="{{route('siteMapGenerator')}}" method="POST">
                            @csrf
                            @method('post')
                            <button class="btn btn-success m-1">Site Map Oluştur</button>
                        </form>
                        <form action="{{route('cacheClear')}}" method="POST">
                            @csrf
                            @method('post')
                            <button class="btn btn-success m-1">Ön Belleği Temizle</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
