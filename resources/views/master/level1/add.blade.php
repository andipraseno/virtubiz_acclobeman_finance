@extends('actasys.main')

@section('container')
    @php
        $ada = count($post) > 0 ? true : false;

        $id = old('id', $ada ? $post[0]['id'] : '');
        $nama = old('nama', $ada ? $post[0]['nama'] : '');
        $tipe = old('tipe', $ada ? $post[0]['tipe'] : '');
    @endphp

    @include('actasys._navbar', [
        'menu_id' => 2,
    ])

    <div class="container" style="margin-top: 100px; width: 400px">
        <div class="card">
            <div class="card-header p-4">
                <div class="text-center">
                    <h4 class="text-danger">
                        <i class="bi bi-stickies"></i> {{ $ada ? 'EDIT' : 'TAMBAH' }} AKUN LEVEL 1
                    </h4>
                </div>
            </div>

            <div class="card-body p-5">
                <form action="{{ url('/master/level1_save') }}" method="post" autocomplete="off">
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
                        <div class="form-floating">
                            <select class="form-select" id="cboTipe" name="tipe"
                                aria-label="Floating label select example">
                                <option value="1">Rill</option>
                                <option value="2">Nominal</option>
                            </select>

                            <label for="cboTipe">Tipe</label>
                        </div>
                    </div>

                    <a href="{{ url('/master/level1') }}" type="button" class="btn btn-outline-dark">
                        <i class="bi bi-box-arrow-left"></i> Kembali
                    </a>

                    <button type="submit" class="btn btn-outline-dark" id="pay-button">
                        <i class="bi bi-check-lg"></i> Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>

    @include('actasys._footer')

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
