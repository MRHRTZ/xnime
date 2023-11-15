@extends('layout.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('episodes', $anime, $episode_id) }}
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
                                class="anime-server__link {{ $server->id == $server_id ? 'active' : '' }}">{{
                                $server->server }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="episode-box">
                @if ($video_type == 'source')
                <video id="normal-player" autoplay="true" playsinline controls data-poster="{{ $anime->image_video }}">
                    <source id="normal-source" src="{{ $video_url }}" type="video/mp4" onerror="player_onerror(event);">
                </video>
                @elseif ($video_type == 'stream')
                <video id="stream-player" class="video-js vjs-fluid" controls preload
                    poster="{{ $anime->image_video }}">
                    <source id="stream-source" src="{{ $video_url }}" type="application/x-mpegURL"
                        onerror="player_onerror(event);">
                </video>
                @elseif ($video_type == 'embed')
                <iframe id="embed-player" height="540px" src="{{ $video_url }}" title="{{ $anime->title }}">
                </iframe>
                @elseif ($video_type == 'broken')
                <div class="player-error">
                    <div class="">
                        <h2>Link Video Rusak :(</h2>
                        <button class="button mt--10">Laporkan</button>
                    </div>
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
                        <p class="anime-info__synopsis mt--10">{{ html_entity_decode($anime->content) }}</p>
                        <table class="datasheet__table mt--10">
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
            <div class="aside-eps__box">
                <ul class="episode-box__list">
                    @foreach ($anime->episodes as $episode)
                    <li class="episode-box__item">
                        <a href="{{ route('episodes', ['anime_id'=>$anime->id, 'episode_id'=>$episode->id]) }}"
                            class="episode-box__link {{ $episode->id == $episode_id ? 'box--active' : '' }}">{{
                            $episode->episode }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <br>
            <hr><br>
            <h1 class="aside__title">Populer</h1>
            <div id="popular" class="aside__box">
                @foreach ($anime_list as $popular)
                <div class="popular-item">
                    <div class="popular-item__cover">
                        <a href="{{ route('detail-anime', ['id'=>$popular->id]) }}">
                            <img src="{{ $popular->imageCover }}" class="popular-item__img">
                        </a>
                    </div>
                    <div class="popular-item__info">
                        <a href="{{ route('detail-anime', ['id'=>$popular->id]) }}" class="popular-item__title">{{
                            html_entity_decode($popular->title) }}</a>
                        <span class="popular-item__description">{{ $popular->tahun }} | Eps. {{ $popular->episode }} |
                            {{ $popular->rating }}</span>
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
<script src="https://vjs.zencdn.net/8.6.1/video.min.js"></script>
<script src="https://cdn.streamroot.io/videojs-hlsjs-plugin/1/stable/videojs-hlsjs-plugin.js"></script>
<script>

</script>
<script>
    function player_onerror(event) {
        console.log(event)
        $('video').remove();
        $('iframe').remove();
        $('.episode-box').prepend(`
        <div class="player-error">
            <div class="">
                <h2>Link Video Rusak :(</h2>
                <button class="button mt--10">Laporkan</button>
            </div>
        </div>
        `)
    }
    $(document).ready(function () {
        if ($('#normal-player').length) {
            var isStarted = false;

            const player = new Plyr('#normal-player');
            window.player = player;

            

            player.on('error', event => console.error('Doh!', player.error, event), false);

            player.on('timeupdate', (event) => {
                // console.log(event);
                // const instance = event.detail.plyr;
                // setTimeout(() => {
                    // let currTime = event.timeStamp
                    // if (currTime > 1000) {
                    //     if (!isStarted) {
                    //         isStarted = true;
                    //         player.currentTime = 120
                    //     }
                    // } 
                // }, 1000);
            // const instance = event.detail.plyr;
                // console.log(event)
            });
        } else if ($('#stream-player').length) {
            var playerStream = videojs('#stream-player');

            // playerStream.on('ended', function() {
            //     this.dispose();
            // });

            // playerStream.ready(function() {
            // // get
            // var howLoudIsIt = playerStream.volume();
            // // set
            // playerStream.volume(0.5); // Set volume to half
            // });
        } else if ($('#embed-player').length) {
            // const url = $('#embed-player').attr('src')
            // $.ajax({
            //     url,
            //     type: 'HEAD',
            //     error: function(data) {
            //         player_onerror()
            //     }
            // });
            // window.addEventListener('DOMContentLoaded', function(e) {
            //     var iFrame = document.getElementById( 'embed-player' );
            //     iFrame.width  = iFrame.contentWindow.document.body.scrollWidth;
            //     iFrame.height = iFrame.contentWindow.document.body.scrollHeight;
            // });
        }
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
                    <div class="popular-item__cover">
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