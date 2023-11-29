@extends('layout.master')

@section('content')
<section class="section auth">
    <h1 class="section__title">Buat Akun</h1>
    @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
        <div class="alert-message --danger">
            <p>{{ $error }}</p>
        </div>
        @endforeach
    </ul>
    @endif

    @if(session('success'))
    <div class="alert-message --success">
        <p>{{session('success')}}</p>
    </div>
    @endif
    <div class="auth-box">
        <form action="{{ route('register_process') }}" method="POST" class="auth-box__form">
            @csrf
            <div class="form-control">
                <label for="name" class="form-control__label">Nama:</label>
                <input type="text" name="name" class="form-control__input" placeholder="Masukan nama ..." required>
            </div>
            <div class="form-control">
                <label for="email" class="form-control__label">E-mail:</label>
                <input type="email" name="email" class="form-control__input" placeholder="Masukan email ..." required>
            </div>
            <div class="form-control">
                <label for="password" class="form-control__label">Password:</label>
                <input type="password" name="password" class="form-control__input" placeholder="Masukan password ..."
                    required>
            </div>
            <div class="form-control">
                <label for="password_confirmation" class="form-control__label">Konfirmasi Password:</label>
                <input type="password" name="password_confirmation" class="form-control__input"
                    placeholder="Konfirmasi password ..." required>
            </div>
            <button type="submit" class="button mt--20">Register</button>
            <div class="switch-auth">
                <a href="{{ route('login') }}">Sudah punya akun? Login.</a>
            </div>
        </form>
    </div>
</section>
@endsection