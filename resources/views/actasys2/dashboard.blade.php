@extends('actasys2._main')

@section('container')
    <style>
        .boxme {
            border: 1px solid #016efc;
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.5);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .card-header h4 span {
                font-size: 10pt;
                /* Adjust the font size for smaller screens */
            }

            .btn i {
                font-size: 16pt;
                /* Make icons smaller on smaller screens */
            }

            .btn span {
                font-size: 12pt;
                /* Adjust text size within buttons */
            }
        }

        .equal-width-btn {
            min-width: 110px;
        }
    </style>

    @include('actasys2._menu', [
        'menu_id' => 1,
    ])

    <div class="container" style="margin-top: 100px">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="text-center">
                            <h4 class="text-primary mb-3">
                                <span style="font-size: 12pt; color: rgb(100, 100, 100)">Selamat datang
                                    {{ Session::get('actasys_user_nama') }}</span><br />
                                <span
                                    style="font-size: 30pt; color:darkslategray">{{ Session::get('actasys_company_nama') }}<br />
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('actasys2._footer')
@endsection
