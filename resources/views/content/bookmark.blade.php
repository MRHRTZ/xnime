@extends('layout.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('bookmark') }}
@endsection

@section('content')
<main class="main">
    @if ($history_data->count() > 0)
    <section class="recommend section featured mb--40">
        <h1 class="section__title">Riwayat</h1>
        <div class="history cards__container">
            @foreach ($history_data as $history)
            <div class="history-card card">
                <div class="history-card__thumbnail-box">
                    <a target="_blank"
                        href="{{ route('episodes', ['anime_id'=>$history->anime_id,'episode_id'=>$history->episode_id,'server_id'=>$history->server_id]) }}"><img
                            onerror="this.src = '{{ url('assets/img/logo/2.png') }}'" src="{{ $history->image }}"
                            class="history-card__thumbnail-img"></a>
                    <a target="_blank"
                        href="{{ route('episodes', ['anime_id'=>$history->anime_id,'episode_id'=>$history->episode_id,'server_id'=>$history->server_id]) }}"
                        class="play__circle">
                        <i class="fa-solid fa-play play__icon"></i>
                    </a>
                </div>
                <div class="history-card__progress">
                    <div id="progress-{{ $history->anime_id }}" class="progressbar">
                    </div>
                </div>
                <div class="history-card__info">
                    <p class="history-card__description mb--5"><b>Episode {{ $history->episode }}</b></p>
                    <a target="_blank" href="{{ route('detail-anime', ['id'=>$history->anime_id]) }}"
                        class="history-card__title">{!!
                        htmlspecialchars_decode(htmlspecialchars_decode(html_entity_decode($history->title))) !!}</a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif
    <div class="wrapper mt--none">
        <section class="section cards">
            <h1 class="section__title">Bookmark</h1>
            <div class="bookmark cards__container">
                @for ($i=0;$i<6;$i++) <div class="bookmark-card card">
                    <div class="bookmark-card__thumbnail-box">
                        <a href="{{ route('detail-anime', ['id'=>1]) }}"><img
                                onerror="this.src = '{{ url('assets/img/logo/2.png') }}'"
                                src="{{ url('assets/img/logo/1.png') }}" class="bookmark-card__thumbnail-img"></a>
                        <a href="{{ route('detail-anime', ['id'=>1]) }}" class="play__circle">
                            <i class="fa-solid fa-play play__icon"></i>
                        </a>
                        <span class="bookmark-card__language-box">
                            <i class="fa-regular fa-star" class="rating"></i>&nbsp;{{ "7.24" }}
                        </span>
                    </div>
                    <div class="bookmark-card__info">
                        <p class="bookmark-card__description"><b>{{ "2021" }}</b></p>
                        <a href="{{ route('detail-anime', ['id'=>1]) }}" class="episode-card__title">{!!
                            htmlspecialchars_decode(htmlspecialchars_decode(html_entity_decode("Hyosukee"))) !!}</a>
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
    $(document).ready(function () {
        @foreach ($history_data as $history)  
            $('#progress-{{ $history->anime_id }}').css('width', '{{ $history->progress }}%');
        @endforeach
    });
</script>
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
<script>
    $(document).ready(function () { 
        $('title').text('Xnime - Bookmark');
    })
</script>
@endsection