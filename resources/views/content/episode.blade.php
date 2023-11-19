@extends('layout.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('episodes', $anime, $episode_id) }}
@endsection

@section('link')
<link rel="stylesheet" href="{{ url('assets/css/vjsdownload.css') }}">
@endsection

@section('content')
<main class="main">
    <div class="wrapper mt--none">
        <section class="section episode">

            <div class="server-info">
                <div>
                    <ul class="anime-server__list">
                        @foreach ($server_list as $server)
                        <li class="anime-server__item">
                            <a href="{{ $server->id == $server_id ? '#' : route('episodes', ['anime_id'=>$anime->id, 'episode_id'=>$episode_id,'server_id'=>$server->id]) }}"
                                id="{{ $server->server }}" data-url="{{ $server->url }}"
                                data-quality="{{ $server->size }}"
                                class="anime-server__link {{ $server->id == $server_id ? 'active disabled' : '' }}">{{
                                $server->server }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="episode-box card">
                @if ($video_type == 'source')
                <video id="normal-player" autoplay="true" playsinline controls data-poster="{{ $anime->image_video }}">
                    <source id="normal-source" src="{{ $video_url }}" type="video/mp4" onerror="player_onerror(event);">
                </video>
                @elseif ($video_type == 'stream')
                <video id="stream-player" class="video-js vjs-fluid" controls preload
                    poster="{{ $anime->image_video }}">
                    <source id="stream-source" src="{{ $video_url }}" type="application/x-mpegURL">
                </video>
                @elseif ($video_type == 'embed')
                <iframe id="embed-player" height="540px" src="{{ $video_url }}" title="{{ $anime->title }}">
                </iframe>
                @elseif ($video_type == 'broken')
                <div class="player-error">
                    <form action="{{ route('report-broken') }}" method="POST">
                        @csrf
                        <input type="hidden" name="anime_id" value="{{ app('request')->route('anime_id') }}">
                        <input type="hidden" name="episode_id" value="{{ app('request')->route('episode_id') }}">
                        <input type="hidden" name="server_id" value="{{ app('request')->query('server_id') }}">
                        <h2>Link Video Rusak :(</h2>
                        @if ($user_report != 'true')
                        <button type="{{ Auth::check() ? 'submit' : 'button' }}" class="button mt--10"
                            onclick="{{ Auth::check() ? '' : 'need_login("'.route(' login').'")' }}">Laporkan</button>
                        @else
                        <br>
                        <p>Telah dilaporkan.</p>
                        @endif
                    </form>
                </div>
                @endif
                <div class="anime-info">
                    <div class="anime-info__cover">
                        <a href="{{ route('detail-anime', ['id'=>$anime->id]) }}">
                            <img src="{{ $anime->image_cover }}" class="anime-info__img">
                        </a>
                    </div>
                    <div class="anime-info__summary">
                        <a href="{{ route('detail-anime', ['id'=>$anime->id]) }}" class="anime-info__title">{{
                            html_entity_decode($anime->title)
                            }}</a>
                        <ul class="anime-genres__list mt--10">
                            @foreach ($anime->categories as $genre)
                            <li class="anime-genres__item">
                                <a href="{{ route('anime', ['genre'=>$genre->cat_id]) }}" class="anime-genres__link">{{
                                    $genre->title }}</a>
                            </li>
                            @endforeach
                        </ul>
                        <p class="anime-info__synopsis mt--10">{!!
                            htmlspecialchars_decode(htmlspecialchars_decode(html_entity_decode($anime->content))) !!}
                        </p>
                        <table class="datasheet__table mt--10">
                            <tr class="datasheet__tr">
                                <td class="datasheet__td">Rating:</td>
                                <td class="datasheet__td">{{ $anime->rating }}</td>
                            </tr>
                            <tr class="datasheet__tr">
                                <td class="datasheet__td">Tahun:</td>
                                <td class="datasheet__td">{{ $anime->tahun }}</td>
                            </tr>
                            <tr class="datasheet__tr">
                                <td class="datasheet__td">Tipe:</td>
                                <td class="datasheet__td">
                                    @if ($anime->jenis_anime == '1')
                                    Series
                                    @elseif ($anime->jenis_anime == '3')
                                    Movie
                                    @elseif ($anime->jenis_anime == '4')
                                    Live Action
                                    @else
                                    Anime
                                    @endif
                                </td>
                            </tr>
                            <tr class="datasheet__tr">
                                <td class="datasheet__td">Vote:</td>
                                <td class="datasheet__td">{{ $anime->voting }}</td>
                            </tr>
                            <tr class="datasheet__tr">
                                <td class="datasheet__td">Status:</td>
                                <td class="datasheet__td">
                                    @if ($anime->status_tayang == '1')
                                    Ongoing
                                    @elseif ($anime->status_tayang == '2')
                                    Completed
                                    @endif
                                </td>
                            </tr>
                            <tr class="datasheet__tr">
                                <td class="datasheet__td">Total Episode:</td>
                                <td class="datasheet__td">{{ $anime->total_episode }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <aside class="aside mt--6-5">
            <h1 class="aside__title">Episode</h1>
            <div class="aside-eps__box card">
                <ul class="episode-box__list">
                    @foreach ($anime->episodes as $episode)
                    <li id="{{ $episode->id }}"
                        class="episode-box__item episode-box__link {{ $episode->id == $episode_id ? 'box--active' : '' }}"
                        onclick="window.location.href = '{{ route('episodes', ['anime_id'=>$anime->id, 'episode_id'=>$episode->id]) }}'">
                        <a class="{{ $episode->id == $episode_id ? 'active' : '' }}">
                            {{ $episode->episode }}
                        </a>
                        @foreach ($history_list as $history)
                        @if ($history->episode_id == $episode->id)
                        <span class="anime-episodes-box-time {{ $episode->id == $episode_id ? 'active' : '' }}">
                            {{ secondToTime($history->play_time) }}
                        </span>
                        @endif
                        @endforeach
                    </li>
                    @endforeach
                </ul>
            </div>
            <br>
            <hr class="divider">
            <br>
            <h1 class="aside__title">Populer</h1>
            <div id="popular" class="popular-box">
                @foreach ($anime_list as $popular)
                <div class="popular-item">
                    <div class="popular-item__cover card">
                        <a href="{{ route('detail-anime', ['id'=>$popular->id]) }}">
                            <img src="{{ $popular->imageCover }}" class="popular-item__img">
                        </a>
                    </div>
                    <div class="popular-item__info">
                        <a href="{{ route('detail-anime', ['id'=>$popular->id]) }}" class="popular-item__title">{!!
                            htmlspecialchars_decode(htmlspecialchars_decode(html_entity_decode($popular->title)))
                            !!}</a>
                        <span class="popular-item__description">{{ $popular->tahun }} | Eps. {{ $popular->episode }} |
                            <i class="fa-regular fa-star" class="rating"></i> {{ $popular->rating }}</span>
                    </div>
                </div>
                @endforeach

            </div>
        </aside>
    </div>
    </aside>
    </div>
</main>
@endsection

@section('script')
<script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
<script src="https://vjs.zencdn.net/7.4.1/video.js"></script>
<script src="https://cdn.streamroot.io/videojs-hlsjs-plugin/1/stable/videojs-hlsjs-plugin.js"></script>
<script src="{{ url('assets/javascript/vjsdownload.js') }}"></script>
<script>
    function player_onerror(event) {
        console.log(event)
        $('video').remove();
        $('iframe').remove();
        let prependHtml = `
        <div class="player-error">
            <form action="{{ route('report-broken') }}" method="POST">
                @csrf
                <input type="hidden" name="anime_id" value="{{ app('request')->route('anime_id') }}">
                <input type="hidden" name="episode_id" value="{{ app('request')->route('episode_id') }}">
                <input type="hidden" name="server_id" value="{{ app('request')->query('server_id') ? app('request')->query('server_id') : ':server_id' }}">
                <h2>Link Video Rusak :(</h2>
                @if ($user_report != 'true')
                <button type="{{ Auth::check() ? 'submit' : 'button' }}" class="button mt--10" 
                onclick="{{ Auth::check() ? '' : 'need_login("'.route('login').'")' }}">Laporkan</button>
                @else
                <br><p>Telah dilaporkan.</p>
                @endif
            </form>
        </div>
        `
        if (prependHtml.includes(':server_id')) {
            prependHtml = prependHtml.replace(':server_id', servers[0].id)
        }
        $('.episode-box').prepend(prependHtml)
    }

    const episodes = [
        @foreach ($anime->episodes as $episode)
        {
            play: {{ $episode->id == $episode_id ? 'true' : 'false' }},
            id: "{{ $episode->id }}",
            episode: "{{ $episode->episode }}"
        },
        @endforeach
    ]
    const servers = [
        @foreach ($server_list as $server)
        {
            id: "{{ $server->id }}",
            size: "{{ $server->size }}"
        },
        @endforeach
    ]

    const anime_id = {{ app('request')->route('anime_id') }};
    const episode_id = {{ app('request')->route('episode_id') }};
    let server_id = {{ app('request')->query('server_id') ? app('request')->query('server_id') : '0' }};
    if (!server_id) server_id = servers[0].id
    if (!$('input[name=server_id]').val()) $('input[name=server_id]').val(servers[0].id)

    const isVideoPlaying = (video) => !!(video.currentTime > 0 && !video.paused && !video.ended && video.readyState > 2);

    function update_history() {
        const formData = {
            _token: "{{ csrf_token() }}",
            user_id: "{{ Auth::check() ? Auth::user()->user_id : '' }}",
            anime_id: anime_id,
            episode_id: episode_id,
            server_id: server_id ? server_id : servers[0].id,
            play_time: window.player.currentTime,
            max_time: window.player.duration,
            episode: episodes.filter(v => v.play)[0].episode,
        }
        $.ajax({
            url : "{{ route('update-history') }}",
            type: "POST",
            data : formData,
            success: function(data, textStatus, jqXHR){}
        });
    }
</script>
<script>
    function next_video() {
        let indexNow = episodes.findIndex(v => v.play)
        if (episodes[indexNow+1]) {
            const nextEps = episodes[indexNow+1]
            let urlNext = `{{ route('episodes', ['anime_id'=>':anime_id', 'episode_id'=>':episode_id','server_id'=>'id_server']) }}`
            urlNext = urlNext.replace(':anime_id', anime_id)
            .replace(':episode_id', nextEps.id)
            .replace('id_server', server_id)
            window.location.href = urlNext
        }
    }

    document.addEventListener("DOMContentLoaded", function (event) {
        document.querySelector('#stream-player source', function (src) {
            src.onerror = player_onerror;
        })
    });
        
    $(document).ready(function () {
        $("ul.episode-box__list").animate({ scrollTop : $('ul.episode-box__list li.box--active').position().top });

        if ($('#normal-player').length) {
            const player = new Plyr('#normal-player', {
                controls: [
                    'play-large',
                    'play',
                    'progress',
                    'current-time',
                    'mute',
                    'volume',
                    'settings',
                    'pip',
                    'airplay',
                    'download',
                    'fullscreen',
                    'capture'
                ]
            });

            player.on('ended', function (e) {
                next_video()
            })

            window.player = $('#normal-player').get(0)
        } else if ($('#stream-player').length) {
            var playerStream = videojs('#stream-player', {
                plugins: {
                    vjsdownload:{
                    beforeElement: 'playbackRateMenuButton',
                    textControl: 'Download video',
                    name: 'downloadButton',
                    }
                }
            });

            playerStream.on('ended', function (e) {
                next_video()
            })

            window.player = $('#stream-player video').get(0)
        } else if ($('#embed-player').length) {
            $('#embed-player').on('load', function() {
                console.log('created')
                @auth
                Toast.fire({
                    icon: "warning",
                    title: "Informasi",
                    text: "Durasi video menggunakan player ini tidak akan tersimpan."
                });
                @endauth    
            })
        }

        @auth
        if (!$('#embed-player').length) {
            @if ($history_data)  
                window.player.currentTime = {{ $history_data->play_time }}
            @endif

            window.player.addEventListener("play", (event) => {
                update_history()
            });

            window.player.addEventListener("pause", (event) => {
                update_history()
            });

            window.player.addEventListener("seeked", (event) => {
                update_history()
            });

            setInterval(() => {
                if (!isVideoPlaying(window.player)) return
                update_history()
            }, 30_000);
        }
        @endauth
    })
</script>
<script>
    window.animePage = 1
    function fetchAnime() {
        $('#popular').append(`<div class="popular-item popular-load">
            <div class="lds-hourglass"></div>
        </div>`)
        var url = "{{ route('fetch-anime', ['page'=>'']) }}"
        url += window.animePage
        $.getJSON(url, function( data ) {
            $('.popular-load').remove()
            for (const anime of data) {
                $('#popular').append(`
                <div class="popular-item">
                    <div class="popular-item__cover card">
                        <a href="anime-detail?id=${anime.id}">
                            <img src="${anime.imageCover}" class="popular-item__img">
                        </a>
                    </div>
                    <div class="popular-item__info">
                        <a href="/anime-detail?id=${anime.id}" class="popular-item__title">${anime.title}</a>
                        <span class="popular-item__description">${anime.tahun} | Eps. ${anime.episode} |
                            ${anime.rating}</span>
                    </div>
                </div>
                `)
            }
        })
        window.animePage += 1
    }

    $(window).scroll(function() {
    var scrollTop = $(window).scrollTop()
    var windowHeight = $(document).height() - $(window).height() - 1
    if(scrollTop > windowHeight) {
        fetchAnime()
    }
});
</script>
@endsection