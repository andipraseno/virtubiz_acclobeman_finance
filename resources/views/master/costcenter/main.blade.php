@extends('actasys.main')

@section('container')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            padding: 8px;
            text-align: left;
            background-color: #f2f2f2;
            border: none;
        }

        td {
            padding: 8px;
            text-align: left;
            border: none;
        }

        tr {
            border-bottom: 1px solid #000;
        }

        tr:last-child {
            border-bottom: none;
        }
    </style>

    @include('actasys._navbar', [
        'menu_id' => 4,
    ])

    <div class="container" style="margin-top: 100px">
        <div class="card">
            <div class="card-header p-4">
                <div class="text-center">
                    <h3 class="text-danger mb-3">
                        <i class="bi bi-tropical-storm"></i> COST CENTER
                    </h3>

                    <a href="{{ url('/master/costcenter_add') }}" class="btn btn-outline-dark">
                        New
                    </a>
                </div>
            </div>

            <div class="card-body p-5">
                <div class="container section-title" data-aos="fade-up">
                    <div class="row">
                        <table>
                            <tbody>
                                @foreach ($post as $list)
                                    <tr>
                                        <td class="text-end" width="20%">
                                            <a href="{{ url('/master/costcenter_edit/' . $list['id']) }}" type="button"
                                                class="btn btn-outline-dark btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            @if ($list['status'] == 1)
                                                <a href="{{ url('/master/costcenter_terminate/' . $list['id']) }}"
                                                    type="button" class="btn btn-outline-success btn-sm">
                                                    <i class="bi bi-check2-circle"></i>
                                                </a>
                                            @else
                                                <a href="{{ url('/master/costcenter_activate/' . $list['id']) }}"
                                                    type="button" class="btn btn-outline-danger btn-sm">
                                                    <i class="bi bi-ban"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td width="20%">{{ $list['nama'] }}</td>
                                        <td width="30%">Rp.{{ number_format($list['plafond'], 0, '.', ',') }}</td>
                                    </tr>
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
