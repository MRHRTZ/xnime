@extends('layout.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('beranda') }}
@endsection

@section('content')
<section class="recommend section featured">
    <h1 class="section__title">Rekomendasi</h1>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($homepage->recommend as $recommend)
            <div class="swiper-slide">
                <div class="recommend-status">
                    <div class="episode-card__status">
                        <span class="episode-card__rating-box">
                            <i class="fa-regular fa-star" class="rating"></i>&nbsp;{{ $recommend->rating }}
                        </span>
                        <span
                            class="episode-card__status-box {{ $recommend->status_proses == '0' ? 'ongoing' : 'completed'  }}">
                            <i class="fa-solid fa-circle-dot"></i></i>&nbsp;{{ $recommend->status_proses == 0 ? 'ON'
                            :
                            'END' }}
                        </span>
                        <a target="_self" href="{{ route('detail-anime', ['id'=>$recommend->id]) }}">
                            <img onerror="this.src = '{{ url('assets/img/logo/2.png') }}'"
                                src="{{ $recommend->image_cover }}" class="swiper-slide__cover">
                        </a>
                    </div>
                </div>
                <a href="{{ route('detail-anime', ['id'=>$recommend->id]) }}" class="swiper-slide__title">{!!
                    htmlspecialchars_decode(htmlspecialchars_decode(html_entity_decode($recommend->title))) !!}</a>
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
                    @auth
                    @php
                    $history = findObjectByCustomId($history_list, $ongoing->id, 'anime_id');
                    @endphp
                    @endauth
                    @if (isset($history))
                    @if ($history)
                    <a target="_self"
                        href="{{ route('episodes', ['anime_id'=>$history->anime_id,'episode_id'=>$history->episode_id,'server_id'=>$history->server_id]) }}"><img
                            onerror="this.src = '{{ url('assets/img/logo/2.png') }}'" src="{{ $ongoing->image_cover }}"
                            class="episode-card__thumbnail-img"></a>
                    <a target="_self"
                        href="{{ route('episodes', ['anime_id'=>$history->anime_id,'episode_id'=>$history->episode_id,'server_id'=>$history->server_id]) }}"
                        class="play__circle">
                        <i class="fa-solid fa-play play__icon"></i>
                    </a>
                    @else
                    <a target="_self" href="{{ route('episodes', ['anime_id'=>$ongoing->id,'episode_id'=>'0']) }}"><img
                            onerror="this.src = '{{ url('assets/img/logo/2.png') }}'" src="{{ $ongoing->image_cover }}"
                            class="episode-card__thumbnail-img"></a>
                    <a target="_self" href="{{ route('episodes', ['anime_id'=>$ongoing->id,'episode_id'=>'0']) }}"
                        class="play__circle">
                        <i class="fa-solid fa-play play__icon"></i>
                    </a>
                    @endif
                    @else
                    <a target="_self" href="{{ route('episodes', ['anime_id'=>$ongoing->id,'episode_id'=>'0']) }}"><img
                            onerror="this.src = '{{ url('assets/img/logo/2.png') }}'" src="{{ $ongoing->image_cover }}"
                            class="episode-card__thumbnail-img"></a>
                    <a target="_self" href="{{ route('episodes', ['anime_id'=>$ongoing->id,'episode_id'=>'0']) }}"
                        class="play__circle">
                        <i class="fa-solid fa-play play__icon"></i>
                    </a>
                    @endif
                    <div class="episode-card__status">
                        <span class="episode-card__rating-box">
                            <i class="fa-regular fa-star" class="rating"></i>&nbsp;{{ $ongoing->rating }}
                        </span>
                        <span
                            class="episode-card__status-box {{ $ongoing->status_proses == '0' ? 'ongoing' : 'completed'  }}">
                            <i class="fa-solid fa-circle-dot"></i></i>&nbsp;{{ $ongoing->status_proses == 0 ? 'ON' :
                            'END' }}
                        </span>
                    </div>
                </div>
                <div class="episode-card__info">
                    <p class="episode-card__description"><b>{{ $ongoing->tahun }}</b></p>
                    <a target="_self" href="{{ route('detail-anime', ['id'=>$ongoing->id]) }}"
                        class="episode-card__title">{!!
                        htmlspecialchars_decode(htmlspecialchars_decode(html_entity_decode($ongoing->title)))
                        !!}</a>
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
@endsection

@section('script')
<script>
    var swiper = new Swiper('.mySwiper', {
    // slidesPerView: 'auto',
    slidesPerView: 1,
    visibilityFullFit: true,
    autoResize: false,
    
    loop: true,
    loopFillGroupWithBlank: true,
    spaceBetween: 20,
    breakpoints: {
        320: { slidesPerView: 2, spaceBetween: 10 },
        480: { slidesPerView: 3, spaceBetween: 20 },
        830: { slidesPerView: 4, spaceBetween: 20 },
        1024: { slidesPerView: 5, spaceBetween: 20 },
        1200: { slidesPerView: 6, spaceBetween: 20 }
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    }
});
</script>
@endsection