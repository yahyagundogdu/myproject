@extends('backend.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Dosya Yönetimi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Dosya Yönetimi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <iframe class="embed-responsive-item" src="{{ url("admin/filemanager") }}"
                    style="width: 100%; height: 700px; overflow: hidden; border: none;"></iframe>
        </div>
    </section>
</div>
@endsection

@section('scriptAdd')

<script src="/vendor/laravel-filemanager/js/filemanager.min.js">

</script>

@endsection
