@extends('backend.app')
@php
    use Illuminate\Support\Carbon;
@endphp
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
    @if (Session::has('success'))
     <script>
         alert("{{session('success')}}");
     </script>
     @endif
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Randevu Detayı</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Randevu Detayı</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Randevu Detayı</h3>
                            </div>
                            <div class="card-body">

                                @if ($data->status == 0)
                                    <span class="badge badge-info right">İşlem Yapılmadı</span>
                                @elseif ($data->status==1)
                                    <span class="badge badge-success right">Onaylandı Ve İşlem Yapıldı</span>
                                @elseif ($data->status==2)
                                    <span class="badge badge-warning right">Beklemede</span>
                                @elseif ($data->status==3)
                                    <span class="badge badge-danger right">Red Edildi</span>
                                @endif
                                <div class="form-group">
                                    <p><label>Randevu Tarihi: </label> {{ $data->created_at->format('d-m-y / H:m:s') }}
                                        ({{ $data->created_at->diffForHumans() }})</p>
                                </div>
                                <div class="form-group">

                                    <p><label>Randevu Yeri: </label> {{ $data->data_location }}</p>
                                </div>
                                @php
                                    $datavarible = [];
                                    $json_decode = json_decode($data->form_data, true);
                                    foreach ($json_decode as $key => $datadecode) {
                                        $datavarible += json_decode(json_encode($datadecode), true);
                                    }
                                @endphp
                                @foreach ($datavarible as $lastkey => $lastvarible)
                                    @if ($lastkey != 'file')
                                        <p><label>{{ $lastkey }}:</label> {{ $lastvarible }}</p>
                                    @else
                                        @php
                                            $json_decode_pdf = json_decode(json_encode($lastvarible), true);
                                        @endphp
                                        @foreach ($json_decode_pdf as $pdfkey => $variblepdf)
                                            <div class="form-group">
                                                <label>{{ $pdfkey }}</label>
                                                <a href="{{ Storage::url($variblepdf) }}" target="_blank">{{ $variblepdf }}</a>
                                            </div>
                                        @endforeach
                                    @endif

                                @endforeach
                                {{-- eski kod --}}
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Randevu İşlemleri</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @if (isset($data->log))
                                        <div class="col-sm-12">
                                            @php
                                                $log_list = [];
                                                $logdata[] = json_decode($data->log, true);
                                                foreach ($logdata as $key => $logvalue) {
                                                    $log_list += json_decode(json_encode($logvalue), true);
                                                }
                                            @endphp

                                            @foreach ($log_list as $logval)
                                                <div class="card">
                                                    <div class="card-body">
                                                        @php
                                                            $userInfo = App\Models\User::find($logval['user']);
                                                            $date = $logval['date'];
                                                        @endphp
                                                        <label>{{ $loop->iteration }}-{{ $userInfo->name . ' ' . $userInfo->surname }}
                                                            / </label><small> Tarih: {{Carbon::parse($date)->format('d-m-Y - H:m:s')}} ({{Carbon::parse($date)->diffForHumans()}})</small>

                                                        <p>{{ $logval['data'] }}<br></p>
                                                        @if ($logval['status'] == 0)
                                                            <span class="badge badge-info right">İşlem Yapılmadı</span>
                                                        @elseif ($logval['status']==1)
                                                            <span class="badge badge-success right">Onaylandı Ve İşlem
                                                                Yapıldı</span>
                                                        @elseif ($logval['status']==2)
                                                            <span class="badge badge-warning right">Beklemede</span>
                                                        @elseif ($logval['status']==3)
                                                            <span class="badge badge-danger right">Red Edildi</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    @endif

                                    <div class="col-sm-12">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <form action="{{ route('randevu.update', $data->id) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="form-group">
                                                <b>İşlem açıklaması <small>(Zorunlu*)</small> </b>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" name="log" rows="5"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <select name="status" class="form-control">
                                                    <option {{ $data->status == '0' ? 'selected' : '' }} value="0">İşlem
                                                        Yapılmadı</option>
                                                    <option {{ $data->status == '1' ? 'selected' : '' }} value="1">
                                                        Onaylandı Ve
                                                        İşlem Yapıldı</option>
                                                    <option {{ $data->status == '2' ? 'selected' : '' }} value="2">
                                                        Beklemede
                                                    </option>
                                                    <option {{ $data->status == '3' ? 'selected' : '' }} value="3">Red
                                                        Edildi
                                                    </option>
                                                </select>
                                            </div>
                                            <button type="submit" role="submit" onclick="this.disabled=true;this.parentNode.submit();" class="btn btn-primary">Kaydet</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

@endsection



@section('scriptAdd')


    <script src="/backend/plugins/js/jquery-ui.min.js"></script>
@endsection
