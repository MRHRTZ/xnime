@extends('layout.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('schedule') }}
@endsection

@section('content')
<main class="main">
    <section class="schedule section featured">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($days as $day)
                <div class="swiper-slide schedule-panel card">
                    <span class="day">{{ $day['day'] }}</span>
                    <div class="anime-list">
                        @foreach ($schedules->{$day['no']} as $schedule)
                        <div class="anime-item">
                            @auth
                            @php
                            $history = findObjectByCustomId($history_list, $schedule->id, 'anime_id');
                            @endphp
                            @endauth
                            @if (isset($history))
                            @if ($history)
                            <a target="_blank"
                                href="{{ route('episodes', ['anime_id'=>$history->anime_id,'episode_id'=>$history->episode_id,'server_id'=>$history->server_id]) }}">
                                <img onerror="this.src = '{{ url('assets/img/logo/2.png') }}'"
                                    src="{{ $schedule->image_cover }}" class="swiper-slide__cover">
                                <br>
                                <a target="_blank" href="{{ route('detail-anime', ['id'=>$schedule->id]) }}" class="title">{!!
                                    htmlspecialchars_decode(htmlspecialchars_decode(html_entity_decode($schedule->title)))
                                    !!}</a>
                            </a>
                            @else
                            <a target="_blank"
                                href="{{ route('episodes', ['anime_id'=>$schedule->id,'episode_id'=>'0']) }}">
                                <img onerror="this.src = '{{ url('assets/img/logo/2.png') }}'"
                                    src="{{ $schedule->image_cover }}" class="swiper-slide__cover">
                                <br>
                                <a target="_blank" href="{{ route('detail-anime', ['id'=>$schedule->id]) }}" class="title">{!!
                                    htmlspecialchars_decode(htmlspecialchars_decode(html_entity_decode($schedule->title)))
                                    !!}</a>
                            </a>
                            @endif
                            @else
                            <a target="_blank"
                                href="{{ route('episodes', ['anime_id'=>$schedule->id,'episode_id'=>'0']) }}">
                                <img onerror="this.src = '{{ url('assets/img/logo/2.png') }}'"
                                    src="{{ $schedule->image_cover }}" class="swiper-slide__cover">
                                <br>
                                <a target="_blank" href="{{ route('detail-anime', ['id'=>$schedule->id]) }}" class="title">{!!
                                    htmlspecialchars_decode(htmlspecialchars_decode(html_entity_decode($schedule->title)))
                                    !!}</a>
                            </a>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </section>
    </div>
</main>
@endsection

@section('script')
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 40,
            }
        }
    });
</script>
<script>
    $(document).ready(function () { 
        $('title').text('Xnime - Jadwal Rilis');
    })
</script>
@endsection