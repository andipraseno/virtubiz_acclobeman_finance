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
        'menu_id' => 2,
    ])

    <div class="container" style="margin-top: 100px">
        <div class="card">
            <div class="card-header p-4">
                <div class="text-center">
                    <h3 class="text-danger">
                        <i class="bi bi-stickies"></i> LEVEL 2
                    </h3>
                </div>
            </div>

            <div class="card-body p-5">
                <div class="container section-title" data-aos="fade-up">
                    <div class="row">
                        <table>
                            <tbody>
                                @foreach ($post as $group)
                                    <tr>
                                        <th colspan="2">
                                            {{ $group['level1_nama'] }}
                                            <a href="{{ url('/master/level2_add/' . $group['level1_id']) }}" type="button"
                                                class="btn btn-sm">
                                                <i class="bi bi-plus-circle"></i>
                                            </a>
                                        </th>
                                    </tr>

                                    @foreach ($group['level2s'] as $list)
                                        <tr>
                                            <td class="text-end" width="40%">
                                                <a href="{{ url('/master/level2_edit/' . $list['id']) }}" type="button"
                                                    class="btn btn-outline-dark btn-sm">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                @if ($list['status'] == 1)
                                                    <a href="{{ url('/master/level2_terminate/' . $list['id']) }}"
                                                        type="button" class="btn btn-outline-success btn-sm">
                                                        <i class="bi bi-check2-circle"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ url('/master/level2_activate/' . $list['id']) }}"
                                                        type="button" class="btn btn-outline-danger btn-sm">
                                                        <i class="bi bi-ban"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td width="60%">{{ $list['nama'] }}</td>
                                        </tr>
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
