@extends('actasys.main')

@section('container')
    @include('actasys._navbar', [
        'menu_id' => 1,
    ])

    <div class="form-main">
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

    @include('actasys._footer');
@endsection
