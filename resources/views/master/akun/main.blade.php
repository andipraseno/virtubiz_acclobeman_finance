@extends('actasys.main')

@section('container')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border: none;
        }

        th {
            background-color: #f2f2f2;
        }

        tr {
            border-bottom: 1px solid #000;
        }

        tr:last-child {
            border-bottom: none;
        }
    </style>

    @include('actasys._navbar', ['menu_id' => 3])

    <div class="container" style="margin-top: 100px">
        <div class="card">
            <div class="card-header p-4 text-center">
                <h3 class="text-danger">
                    <i class="bi bi-postcard"></i> ACCOUNT
                </h3>
            </div>

            <div class="card-body p-5">
                <div class="container section-title" data-aos="fade-up">
                    <div class="row">
                        <table>
                            <tbody>
                                @foreach ($post as $level1s)
                                    <tr>
                                        <th colspan="2">{{ $level1s['level1_nama'] }}</th>
                                    </tr>

                                    @foreach ($level1s['level2es'] as $level2)
                                        <tr>
                                            <td colspan="2" class="fw-bold">
                                                <i class="bi bi-arrow-return-right"></i> {{ $level2['level2_nama'] }}
                                            </td>
                                        </tr>

                                        @foreach ($level2['level3es'] as $level3)
                                            @if (count($level3['akun']) > 0)
                                                <tr>
                                                    <td colspan="2" class="fw-bold">
                                                        <span style="padding-left: 20px;">
                                                            <i class="bi bi-arrow-return-right"></i>
                                                            {{ $level3['level3_nama'] }}
                                                        </span>
                                                        <a href="{{ url('/master/akun_add/' . $level3['level3_id']) }}"
                                                            class="btn btn-sm">
                                                            <i class="bi bi-plus-circle"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                @foreach ($level3['akun'] as $akun)
                                                    @if ($akun['status'] != '')
                                                        <tr>
                                                            <td class="text-end" width="40%">
                                                                <a href="{{ url('/master/akun_edit/' . $akun['id']) }}"
                                                                    class="btn btn-outline-dark btn-sm">
                                                                    <i class="bi bi-pencil"></i>
                                                                </a>
                                                                @if ($akun['status'] == 1)
                                                                    <a href="{{ url('/master/akun_terminate/' . $akun['id']) }}"
                                                                        class="btn btn-outline-success btn-sm">
                                                                        <i class="bi bi-check2-circle"></i>
                                                                    </a>
                                                                @else
                                                                    <a href="{{ url('/master/akun_activate/' . $akun['id']) }}"
                                                                        class="btn btn-outline-danger btn-sm">
                                                                        <i class="bi bi-ban"></i>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                            <td width="60%">{{ $akun['nama'] }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('actasys._footer')
@endsection
