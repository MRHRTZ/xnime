@extends('layout.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('beranda') }}
@endsection

@section('content')
<main class="main">
    <section class="recommend section featured">
        <h1 class="section__title">Rekomendasi</h1>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($homepage->recommend as $recommend)
                <div class="swiper-slide">
                    <a href="{{ route('detail-anime', ['id'=>$recommend->id]) }}">
                        <img src="{{ $recommend->image_cover }}" class="swiper-slide__cover">
                    </a>
                    <a href="{{ route('detail-anime', ['id'=>$recommend->id]) }}" class="swiper-slide__title">{{
                        html_entity_decode($recommend->title) }}</a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </section>
    <div class="wrapper mt--none">
        <section class="section cards">
            <h1 class="section__title">Update Terbaru</h1>
            <div class="cards__container">
                @foreach ($homepage->ongoing as $ongoing)
                <div class="episode-card card">
                    <div class="episode-card__thumbnail-box">
                        <a href="{{ route('detail-anime', ['id'=>$ongoing->id]) }}"><img
                                src="{{ $ongoing->image_cover }}" class="episode-card__thumbnail-img"></a>
                        <a href="{{ route('detail-anime', ['id'=>$ongoing->id]) }}" class="play__circle">
                            <ion-icon name="play-circle" class="play__icon"></ion-icon>
                        </a>
                        <span class="episode-card__language-box">
                            <i class="fa-regular fa-star" class="rating"></i>&nbsp;{{ $ongoing->rating }}
                        </span>
                    </div>
                    <div class="episode-card__info">
                        <p class="episode-card__description"><b>{{ $ongoing->tahun }}</b></p>
                        <a href="{{ route('detail-anime', ['id'=>$ongoing->id]) }}" class="episode-card__title">{{
                            html_entity_decode($ongoing->title) }}</a>
                        <p class="episode-card__description">Episode {{ $ongoing->episode }} / {{ $ongoing->totalEpisode
                            ?? '-' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        <aside class="aside">
            <h1 class="aside__title">Genre</h1>
            <div class="aside__box card">
                <ul class="genres-box__list">
                    @foreach ($genres as $genre)
                    <li class="genres-box__item">
                        <a href="{{ route('anime', ['genre'=>$genre->id]) }}" class="genres-box__link">{{ $genre->title
                            }}</a>
                    </li>
                    @endforeach
                </ul>
                <button type="button" class="button load-more">Tampilkan Lebih Banyak</button>
            </div>
        </aside>
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