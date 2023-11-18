@extends('layout.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('beranda') }}
@endsection

@section('content')
<main class="main">
    <section class="recommend section featured">
        <h1 class="section__title">Riwayat</h1>
    </section>
    <div class="wrapper mt--none">
        <section class="section cards">
            <h1 class="section__title">Update Terbaru</h1>
            <div class="cards__container">
                @for ($i=0;$i<6;$i++)
                <div class="episode-card card">
                    <div class="episode-card__thumbnail-box">
                        <a href="{{ route('detail-anime', ['id'=>1]) }}"><img
                                src="{{ url('assets/img/logo/1.png') }}" class="episode-card__thumbnail-img"></a>
                        <a href="{{ route('detail-anime', ['id'=>1]) }}" class="play__circle">
                            <ion-icon name="play-circle" class="play__icon"></ion-icon>
                        </a>
                        <span class="episode-card__language-box">
                            <i class="fa-regular fa-star" class="rating"></i>&nbsp;{{ "7.24" }}
                        </span>
                    </div>
                    <div class="episode-card__info">
                        <p class="episode-card__description"><b>{{ "2021" }}</b></p>
                        <a href="{{ route('detail-anime', ['id'=>1]) }}" class="episode-card__title">{{
                            html_entity_decode("Hyosukee") }}</a>
                    </div>
                </div>
                @endfor
                {{-- @foreach ($homepage->ongoing as $ongoing)
                
                @endforeach --}}
            </div>
        </section>
    </div>
</main>
@endsection

@section('script')
<script>
    var swiper = new Swiper('.mySwiper', {
    slidesPerView: 'auto',
    loop: true,
    loopFillGroupWithBlank: true,
    spaceBetween: 20,
    breakpoints: {
        320: { spaceBetween: 10 },
        480: { spaceBetween: 20 }
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    }
});
</script>
@endsection