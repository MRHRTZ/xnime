@extends('layout.master')

@section('content')
<main class="main">
    <section class="section contact">
        <h1 class="section__title">Masuk Akun</h1>
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
        <div class="contact-box">
            <form action="{{ route('login_process') }}" method="POST" class="contact-box__form">
                @csrf
                <div class="form-control">
                    <label for="email" class="form-control__label">E-mail:</label>
                    <input type="email" name="email" class="form-control__input" placeholder="Masukan email ..."
                        required>
                </div>
                <div class="form-control">
                    <label for="password" class="form-control__label">Password:</label>
                    <input type="password" name="password" class="form-control__input"
                        placeholder="Masukan password ..." required>
                </div>
                <label class="label-checkbox">Ingat Saya
                    <input type="checkbox" name="remember">
                    <span class="checkbox"></span>
                </label>
                <div class="form-control">
                </div>
                <button type="submit" class="button mt--20">Login</button>
                <div class="switch-auth">
                    <a href="{{ route('register') }}">Belum punya akun? Register.</a>
                </div>
            </form>
        </div>
    </section>
</main>
@endsection