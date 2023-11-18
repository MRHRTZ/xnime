@extends('layout.master')

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
                            <a href="{{ route('detail-anime', ['id'=>$schedule->id]) }}">
                                <img src="{{ $schedule->image_cover }}" class="swiper-slide__cover">
                                <br>
                                <span class="title">{{ html_entity_decode($schedule->title) }}</span>
                            </a>
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

    // var swiper = new Swiper('.mySwiper', {
    // slidesPerView: 4,
    // spaceBetween: 20,
    // breakpoints: {
    //     320: { spaceBetween: 10 },
    //     480: { spaceBetween: 20 }
    // },
    // navigation: {
    //     nextEl: ".swiper-button-next",
    //     prevEl: ".swiper-button-prev",
    // }
// })
</script>
@endsection