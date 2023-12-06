@extends('layout.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('schedule') }}
@endsection

@section('content')
<section class="schedule section featured">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($days as $day)
            <div id="day-{{ $day['no'] }}" class="swiper-slide">
                <div class="schedule-panel card">
                    <span class="day">{{ $day['day'] }}</span>
                    <span class="week"></span>
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
                            <a target="_self"
                                href="{{ route('episodes', ['anime_id'=>$history->anime_id,'episode_id'=>$history->episode_id,'server_id'=>$history->server_id]) }}">
                                <img onerror="this.src = '{{ url('assets/img/logo/2.png') }}'"
                                    src="{{ $schedule->image_cover }}" class="swiper-slide__cover">
                                <br>
                                <a target="_self" href="{{ route('detail-anime', ['id'=>$schedule->id]) }}"
                                    class="title">{!!
                                    htmlspecialchars_decode(htmlspecialchars_decode(html_entity_decode($schedule->title)))
                                    !!}</a>
                            </a>
                            @else
                            <a target="_self"
                                href="{{ route('episodes', ['anime_id'=>$schedule->id,'episode_id'=>'0']) }}">
                                <img onerror="this.src = '{{ url('assets/img/logo/2.png') }}'"
                                    src="{{ $schedule->image_cover }}" class="swiper-slide__cover">
                                <br>
                                <a target="_self" href="{{ route('detail-anime', ['id'=>$schedule->id]) }}"
                                    class="title">{!!
                                    htmlspecialchars_decode(htmlspecialchars_decode(html_entity_decode($schedule->title)))
                                    !!}</a>
                            </a>
                            @endif
                            @else
                            <a target="_self"
                                href="{{ route('episodes', ['anime_id'=>$schedule->id,'episode_id'=>'0']) }}">
                                <img onerror="this.src = '{{ url('assets/img/logo/2.png') }}'"
                                    src="{{ $schedule->image_cover }}" class="swiper-slide__cover">
                                <br>
                                <a target="_self" href="{{ route('detail-anime', ['id'=>$schedule->id]) }}"
                                    class="title">{!!
                                    htmlspecialchars_decode(htmlspecialchars_decode(html_entity_decode($schedule->title)))
                                    !!}</a>
                            </a>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</section>
@endsection

@section('script')
<script>
    function dayNow() {
        var today = new Date();
        var dayNumber = today.getDay();
        return (dayNumber === 0) ? 7 : dayNumber;
    }

    function weekNow() {
        var today = new Date();
        var dayOfWeek = today.getDay();
        var daysToMonday = (dayOfWeek + 6) % 7;
        var mondayDate = new Date(today);
        mondayDate.setDate(today.getDate() - daysToMonday);
        var weekDates = [];
        for (var i = 0; i < 7; i++) {
            var currentDate = new Date(mondayDate);
            currentDate.setDate(mondayDate.getDate() + i);
            var formattedDate = currentDate.getDate() + '/' + (currentDate.getMonth() + 1);
            weekDates.push(formattedDate);
        }
        return weekDates
    }

    var swiper = new Swiper(".mySwiper", {
        initialSlide: dayNow()-1,
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 30,
            }
        }
    });
</script>
<script>
    $(document).ready(function () { 
        $('title').text('Jadwal Rilis | Xnime ID');
        var day_now = dayNow()
        $(`#day-${day_now} .day`).addClass('active');
        var week_now = weekNow()
        $(`div[id*=day-]`).each(function (i, el) {
            $(el).find('.week').text(week_now[i])
        })
    })
</script>
@endsection