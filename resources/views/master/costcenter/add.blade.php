@extends('actasys2._main')

@section('container')
    @php
        $ada = count($post) > 0 ? true : false;

        $id = old('id', $ada ? $post[0]['id'] : '');
        $nama = old('nama', $ada ? $post[0]['nama'] : '');
        $plafond = old('plafond', $ada ? $post[0]['plafond'] : '');
    @endphp

    @include('actasys2._menu', [
        'menu_id' => 4,
    ])

    <div class="container" style="margin-top: 100px; width: 400px">
        <div class="card">
            <div class="card-header p-4">
                <div class="text-center">
                    <h4 class="text-danger">
                        <i class="bi bi-tropical-storm"></i> {{ $ada ? 'EDIT' : 'TAMBAH' }} COST CENTER
                    </h4>
                </div>
            </div>

            <div class="card-body p-5">
                <form action="{{ url('/master/costcenter_save') }}" method="post" autocomplete="off">
                    @csrf

                    <input type="hidden" id="txtId" name="id" value="{{ $id }}">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="txtNama"
                            name="nama" value="{{ $nama }}" autofocus>
                        <label for="txtNama">Nama</label>

                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('plafond') is-invalid @enderror" id="txtPlafond"
                            name="plafond" value="{{ $plafond }}" autofocus>
                        <label for="txtPlafond">Plafond</label>

                        @error('plafond')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <a href="{{ url('/master/costcenter') }}" type="button" class="btn btn-outline-dark">
                        <i class="bi bi-box-arrow-left"></i> Kembali
                    </a>

                    <button type="submit" class="btn btn-outline-dark" id="pay-button">
                        <i class="bi bi-check-lg"></i> Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>

    @include('actasys2._footer')

    <script>
        new Cleave('#txtPlafond', {
            numeral: true,
            numeralThousandsGroupStyle: "thousand",
            rawValueTrimPrefix: true,
            numeralDecimalMark: ",",
            numeralDecimalScale: 2,
            delimiter: ".",
        });
    </script>

    @if (session('formSuccess'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('formSuccess') }}",
                    icon: 'success',
                    position: 'top',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        </script>
    @endif
@endsection
