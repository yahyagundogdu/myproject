@extends('backend.app')

@section('cssAdd')
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
                        <h1>Randevu Talepleri</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Randevular</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header">
                        <h3 class="card-title">Randevu Talepleri</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('randevusearch') }}" method="post">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <label for="search">Arama Yapın</label>
                                <input value="{{ old('search') }}" name="search" type="search" class="form-control"
                                    id="search" placeholder="Arama Yapın" aria-describedby="searchHelp">
                                <small id="searchHelp" class="form-text text-muted">Adı-Soyadı-Tc-Konum</small>
                            </div>
                            <div class="form-check">
                                <input name="type[]" @if (isset($type))
                                {{ in_array('0', $type) ? 'checked' : '' }}
                                @endif
                                class="form-check-input" type="checkbox" value="0" id="islem1">
                                <label class="form-check-label" for="islem1">
                                    İşlem Yapılmadı
                                </label>
                            </div>
                            <div class="form-check">
                                <input @if (isset($type))
                                {{ in_array('1', $type) ? 'checked' : '' }}
                                @endif
                                name="type[]" class="form-check-input" type="checkbox" value="1" id="islem2">
                                <label class="form-check-label" for="islem2">
                                    Onaylandı Ve İşlem Yapıldı
                                </label>
                            </div>
                            <div class="form-check">
                                <input @if (isset($type))
                                {{ in_array('2', $type) ? 'checked' : '' }}
                                @endif
                                name="type[]" class="form-check-input" type="checkbox" value="2" id="islem3">
                                <label class="form-check-label" for="islem3">
                                    Beklemede
                                </label>
                            </div>
                            <div class="form-check">
                                <input @if (isset($type))
                                {{ in_array('3', $type) ? 'checked' : '' }}
                                @endif
                                name="type[]" class="form-check-input" type="checkbox" value="3" id="islem4">
                                <label class="form-check-label" for="islem4">
                                    Red Edildi
                                </label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success mt-2">Arama Yap</button>
                            </div>
                        </form>

                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <th></th>
                                <th>Konum</th>
                                <th>Kişi</th>
                                <th>Durumu</th>
                                <th>Tarih</th>
                                <th>Detaylı İşlem</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><b>{{ $value->data_location }}</b></td>
                                        <td style="display: -webkit-box;
                                                                    -webkit-line-clamp: 10;
                                                                    -webkit-box-orient: vertical;
                                                                    overflow:hidden;line-height: 5px;
                                                                ">
                                            @php
                                                $datavarible = [];
                                                $json_decode = json_decode($value->form_data, true);
                                                foreach ($json_decode as $key => $datadecode) {
                                                    $datavarible += json_decode(json_encode($datadecode), true);
                                                }
                                            @endphp
                                            @foreach ($datavarible as $lastkey => $lastvarible)
                                                @if ($lastkey != 'file')
                                                    <p><label>{{ $lastkey }}:</label>{{ $lastvarible }}</p>

                                                @else
                                                    @php
                                                        $json_decode_pdf = json_decode(json_encode($lastvarible), true);
                                                    @endphp
                                                    @foreach ($json_decode_pdf as $pdfkey => $variblepdf)
                                                        <label>{{ $pdfkey }}</label>
                                                        <a href="{{ Storage::url($variblepdf) }}"
                                                            target="_blank">{{ $variblepdf }}</a>
                                                    @endforeach
                                                @endif

                                            @endforeach




                                        </td>
                                        <td>
                                            @php
                                                $log_list = [];
                                                unset($logdata);
                                                $logdata[] = json_decode($value->log, true);
                                            @endphp
                                            @if ($value->log != null)
                                                @php
                                                    foreach ($logdata as $key => $logvalue) {
                                                        $log_list += json_decode(json_encode($logvalue), true);
                                                    }
                                                    $endLog = end($log_list) ? end($log_list) : '';
                                                    $userInfo = App\Models\User::find($endLog['user']);
                                                    $date = $endLog['date'];
                                                @endphp


                                                <p><label>Son İşlem:</label>
                                                    {{ $userInfo->name . ' ' . $userInfo->surname }}
                                                </p>
                                                <p>
                                                    {{ Str::limit($endLog['data'], 100) }}
                                                </p>
                                            @endif

                                            @if ($value->status == 0)
                                                <h4 class="badge badge-info right">İşlem Yapılmadı</h4>
                                            @elseif ($value->status == 1)
                                                <h4 class="badge badge-success right">Onaylandı Ve İşlem Yapıldı</h4>
                                            @elseif ($value->status == 2)
                                                <h4 class="badge badge-warning right">Beklemede</h4>
                                            @elseif ($value->status == 3)
                                                <h4 class="badge badge-danger right">Red Edildi</h4>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $first_date = $value->created_at;
                                            @endphp
                                            <p>{{ optional($first_date)->format('d-m-y / H:m:s') }}</p>
                                            <p>{{ optional($first_date)->diffForHumans() }}</p>
                                        </td>
                                        <td>
                                            <a href="{{ route('randevu.show', $value->id) }}"
                                                class="btn btn-success btn-sm"><i class="far fa-envelope-open"></i></a>
                                            <form action="{{ route('randevu.destroy', $value->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" role="submit" class="btn btn-danger btn-sm" onclick="clicked(event)"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            {{ $data->links('backend.pages.paginator') }}
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

@endsection



@section('scriptAdd')

    <script src="/backend/plugins/js/jquery-ui.min.js"></script>

    <script>
        function clicked(e)
        {
            if(!confirm('Bu kaydı silmek istediğinize emin misniz ?')) {
                e.preventDefault();
            }
        }
        </script>
@endsection
