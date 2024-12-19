@extends('actasys.login')

@section('container')
    <div class="form-login">
        <form action="{{ url('/login/start') }}" method="post" autocomplete="off">
            @csrf

            <div class="card">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <img class="mb-2" src="{{ url('/images/app-icon.ico') }}" alt="" width="80"
                            height="80">
                        <h5 class="text-dark">{{ config('app.software.nama') }}</h5>
                    </div>

                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="txtEmail"
                                name="email" placeholder="Contoh : nama@example.com">
                            <label for="txtEmail">Email</label>

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="txtPassword" name="password" placeholder="Password">
                            <label for="txtPassword">Password</label>

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <button class="btn btn-outline-dark" type="submit">Masuk</button>

                        <a href="{{ url('/login/reset') }}" class="btn btn-outline-dark" type="submit">Lupa password</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @include('actasys._footer');

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let form_error = @json(Session::has('formError'));
            let form_error_message = @json(Session::get('formError'));

            if (form_error) {
                (async () => {
                    await msgFlash("Gagal", form_error_message, 'error');
                })();
            }
        });
    </script>
@endsection
