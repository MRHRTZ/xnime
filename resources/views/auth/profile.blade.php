@extends('layout.master')

@section('content')
<main class="main">
    <section class="section contact">
        <h1 class="section__title">Edit Profil</h1>
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
            <div class="profile-wrapper" onclick="filePick()">
                <img src="{{ Auth::user()->picture ? url(env('PROFILE_FOLDER').'/'.Auth::user()->picture) : url('assets/img/icons/profile.jpg') }}" class="profile-pic-big" />
                <i class="fa-solid fa-camera"></i>
                <form id="change-pic" action="{{ route('upload_profile') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="file-profile" name="file" accept="image/*" class="hidden">
                </form>
            </div>
            <form action="{{ route('profile_process') }}" method="POST" class="contact-box__form">
                @csrf
                <div class="form-control">
                    <label for="name" class="form-control__label">Nama:</label>
                    <input type="text" name="name" class="form-control__input inputable" value="{{ Auth::user()->name }}">
                </div>
                <div class="form-control">
                    <label for="email" class="form-control__label">E-mail:</label>
                    <input type="email" name="email" class="form-control__input disabled" value="{{ Auth::user()->email }}" readonly>
                </div>
                <div class="form-control">
                    <label for="password" class="form-control__label">Password:</label>
                    <input type="password" name="password" class="form-control__input inputable"
                        placeholder="Isi jika ingin mengubah password ...">
                </div>
                <div class="form-control">
                    <label for="password_confirmation" class="form-control__label">Konfirmasi Password:</label>
                    <input type="password" name="password_confirmation" class="form-control__input inputable">
                </div>
                <button type="submit" class="button mt--20">Simpan</button>
            </form>
        </div>
    </section>
</main>
@endsection

@section('script')
<script>
    function filePick() {
        $('#file-profile')[0].click()
    }

    $('input[type=file]').change(function (e) {
        $('#change-pic').submit()
    });
</script>
@endsection