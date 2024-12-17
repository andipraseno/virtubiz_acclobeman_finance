@extends('actasys1._main')

@section('container')
    <main class="form-signin w-100 m-auto">
        <form action="{{ url('/login') }}" method="post" autocomplete="off">
            @csrf

            <div class="card">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <img class="mb-2" src="{{ url('/assets') }}/banner.png" alt="" width="100px" height="100px">
                        <h5 class="text-secondary" style="font-size: 12pt">{{ config('app.software.nama') }}</h5>
                    </div>

                    @error('email')
                        <div class="alert alert-danger" role="alert">
                            Login gagal!
                        </div>
                    @enderror


                    <div class="form-floating">
                        <input type="text" class="form-control" id="txtEmail" name="email"
                            placeholder="Contoh : nama@example.com" autofocus>
                        <label for="txtEmail">Email</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="txtPassword" name="password" placeholder="Password">
                        <label for="txtPassword">Password</label>
                    </div>

                    <div class="mb-4">
                        <button class="btn btn-outline-dark w-100" type="submit">Masuk</button>
                    </div>
                </div>
            </div>
        </form>
    </main>

    @include('actasys1._footer')
@endsection
