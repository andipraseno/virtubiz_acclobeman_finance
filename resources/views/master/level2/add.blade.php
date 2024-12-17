@extends('actasys2._main')

@section('container')
    @php
        $ada = count($post) > 0 ? true : false;

        $id = old('id', $ada ? $post[0]['id'] : '');
        $nama = old('nama', $ada ? $post[0]['nama'] : '');
    @endphp

    @include('actasys2._menu', [
        'menu_id' => 2,
    ])

    <div class="container" style="margin-top: 100px; width: 400px">
        <div class="card">
            <div class="card-header p-4">
                <div class="text-center">
                    <h4 class="text-danger">
                        <i class="bi bi-stickies"></i> {{ $ada ? 'EDIT' : 'TAMBAH' }} AKUN LEVEL 2
                    </h4>
                </div>
            </div>

            <div class="card-body p-5">
                <form action="{{ url('/master/level2_save') }}" method="post" autocomplete="off">
                    @csrf

                    <input type="hidden" id="txtId" name="id" value="{{ $id }}">
                    <input type="hidden" id="txtLevel1Id" name="level1_id" value="{{ $level1_id }}">

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

                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="txtLevel1Nama" name="level1_nama"
                            value="{{ $level1_nama }}" readonly>
                        <label for="txtLevel1Nama">Level 1</label>
                    </div>

                    <a href="{{ url('/master/level2') }}" type="button" class="btn btn-outline-dark">
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
