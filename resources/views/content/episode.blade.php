@extends('layout.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('episodes', $anime, $episode_id) }}
@endsection

@section('link')
<link rel="stylesheet" href="{{ url('assets/css/vjsdownload.css') }}">
@endsection

@section('content')
<div class="episode wrapper mt--none">
    <section class="section episode">
        <div class="server-info">
            <div>
                <ul class="anime-server__list">
                    @foreach ($server_list as $server)
                    <li class="anime-server__item">
                        <a href="{{ $server->id == $server_id ? '#' : route('episodes', ['anime_id'=>$anime->id, 'episode_id'=>$episode_id,'server_id'=>$server->id]) }}"
                            id="{{ $server->server }}" data-url="{{ $server->url }}" data-quality="{{ $server->size }}"
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
            <video id="stream-player" class="video-js vjs-fluid" controls preload poster="{{ $anime->image_video }}">
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
        </div>
        <div class="anime-info">
            <div class="anime-info__summary">
                @if ($bookmark)
                <div class="bookmark-area" data-bookmark="1" onclick="save_bookmark(this);">
                    <div class="bookmark-button-active">
                        <i class="fa-solid fa-bookmark fa-2xl"></i>
                        <i class="fa-regular fa-circle-check fa-sm"></i>
                    </div>
                </div>
                @else
                <div class="bookmark-area" data-bookmark="0" onclick="save_bookmark(this);">
                    <div class="bookmark-button">
                        <i class="fa-regular fa-bookmark fa-2xl"></i>
                        <i class="fa-solid fa-plus fa-sm"></i>
                    </div>
                </div>
                @endif
                <a class="anime-info__title">{{
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
        <hr class="divider">
        <div class="comment-section">
            <div class="comment-header mt--20">
                <p id="comment--title" class="section__title ">Komentar</p>
                <div class="comment--option">
                    <a onclick="ascending_comment(0)" class="comment-best active">Terbaik</a>
                    <a onclick="ascending_comment(1)" class="comment-latest">Terbaru</a>
                </div>
            </div>
            @auth
            <div class="comments-box__content">
                <div class="user comment">
                    <div class="user-avatar">
                        <img
                            src="{{ Auth::user()->picture ? url('profiles/'.Auth::user()->picture) : url('assets/img/icons/profile.jpg') }}">
                    </div>
                    <div class="comment-content">
                        <div class="input--area">
                            <textarea id="input--comment" data-parent_id="0" cols="1" rows="2"
                                placeholder="Tulis komentar ..."></textarea>
                        </div>
                        <div class="send--button">
                            <a id="post--button" class="disabled">
                                <i class="fa-solid fa-paper-plane"></i>
                                Kirim
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endauth
            @guest
            <div class="comments-box__content" onclick="return need_login('{{ route('login') }}')">
                <div class="user comment">
                    <div class="user-avatar">
                        <img src="{{ url('assets/img/icons/profile.jpg') }}">
                    </div>
                    <div class="comment-content">
                        <div class="input--area">
                            <textarea id="input--comment" cols="1" rows="2" placeholder="Tulis komentar ..."
                                readonly></textarea>
                        </div>
                        <div class="send--button">
                            <a id="post--button" class="disabled">
                                <i class="fa-solid fa-paper-plane"></i>
                                Kirim
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endguest
            <div class="users__comment--content"></div>
        </div>
    </section>
    <aside class="aside mt--6-5">
        <h1 class="aside__title">Episode</h1>
        <div class="aside-eps__box card">
            <ul class="episode-box__list">
                @foreach ($anime->episodes as $episode)
                @auth
                @php
                $history = findObjectByCustomId($history_list, $episode->id, 'episode_id');
                @endphp
                @endauth
                @if (isset($history))
                @if ($history)
                <li id="{{ $episode->id }}"
                    class="episode-box__item episode-box__link {{ $episode->id == $episode_id ? 'box--active' : '' }}"
                    onclick="window.location.href = '{{ route('episodes', ['anime_id'=>$history->anime_id,'episode_id'=>$history->episode_id,'server_id'=>$history->server_id]) }}'">
                    <a class="{{ $episode->id == $episode_id ? 'active' : '' }}">
                        {{ $episode->episode }}
                    </a>
                    <span class="anime-episodes-box-time {{ $episode->id == $episode_id ? 'active' : '' }}">
                        {{ secondToTime($history->play_time) }}
                    </span>
                </li>
                @else
                <li id="{{ $episode->id }}"
                    class="episode-box__item episode-box__link {{ $episode->id == $episode_id ? 'box--active' : '' }}"
                    onclick="window.location.href = '{{ route('episodes', ['anime_id'=>$anime->id, 'episode_id'=>$episode->id]) }}'">
                    <a class="{{ $episode->id == $episode_id ? 'active' : '' }}">
                        {{ $episode->episode }}
                    </a>
                </li>
                @endif
                @else
                <li id="{{ $episode->id }}"
                    class="episode-box__item episode-box__link {{ $episode->id == $episode_id ? 'box--active' : '' }}"
                    onclick="window.location.href = '{{ route('episodes', ['anime_id'=>$anime->id, 'episode_id'=>$episode->id]) }}'">
                    <a class="{{ $episode->id == $episode_id ? 'active' : '' }}">
                        {{ $episode->episode }}
                    </a>
                </li>
                @endif
                @endforeach
            </ul>
        </div>
        <br>
        <hr class="divider">
        <br>
        <div class="popular--header">
            <p class="aside__title">Populer</p>
            <div class="popular--navigation">
                <i id="popular-prev" class="fa-solid fa-chevron-left"></i>
                <i id="popular-next" class="fa-solid fa-chevron-right available"></i>
            </div>
        </div>
        <div id="popular" class="popular-box"></div>
    </aside>
    <div class="mobile-comment-section">
        <hr class="divider">
        <div class="comment-header mt--20">
            <p id="comment--title" class="section__title ">Komentar</p>
            <div class="comment--option">
                <a onclick="ascending_comment(0)" class="comment-best active">Terbaik</a>
                <a onclick="ascending_comment(1)" class="comment-latest">Terbaru</a>
            </div>
        </div>
        @auth
        <div class="comments-box__content">
            <div class="user comment">
                <div class="user-avatar">
                    <img
                        src="{{ Auth::user()->picture ? url('profiles/'.Auth::user()->picture) : url('assets/img/icons/profile.jpg') }}">
                </div>
                <div class="comment-content">
                    <div class="input--area">
                        <textarea id="input--comment" data-parent_id="0" cols="1" rows="2"
                            placeholder="Tulis komentar ..."></textarea>
                    </div>
                    <div class="send--button">
                        <a id="post--button" class="disabled">
                            <i class="fa-solid fa-paper-plane"></i>
                            Kirim
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endauth
        @guest
        <div class="comments-box__content" onclick="return need_login('{{ route('login') }}')">
            <div class="user comment">
                <div class="user-avatar">
                    <img src="{{ url('assets/img/icons/profile.jpg') }}">
                </div>
                <div class="comment-content">
                    <div class="input--area">
                        <textarea id="input--comment" cols="1" rows="2" placeholder="Tulis komentar ..."
                            readonly></textarea>
                    </div>
                    <div class="send--button">
                        <a id="post--button" class="disabled">
                            <i class="fa-solid fa-paper-plane"></i>
                            Kirim
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endguest
        <div class="users__comment--content"></div>
    </div>
</div>
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
    const episode_id = {{ $episode_id }};
    let server_id = {{ $server_id }};
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
            let urlNext = `{{ route('episodes', ['anime_id'=>':anime_id', 'episode_id'=>':episode_id']) }}`
            urlNext = urlNext.replace(':anime_id', anime_id)
            .replace(':episode_id', nextEps.id)
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
                    'play',
                    'progress',
                    'current-time',
                    'mute',
                    'volume',
                    'settings',
                    'pip',
                    'download',
                    'fullscreen',
                ]
            });

            player.on('ended', function (e) {
                update_history()
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
                window.player.currentTime = {{ $history_data->is_ended ? 0 : $history_data->play_time }}
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
    window.animePage = 0
    fetch_popular()

    $(document).ready(function() { 
        $('#popular-next').on('click', function () {
            window.animePage += 1
            fetch_popular()
        })
        
        $('#popular-prev').on('click', function () {
            if (!window.animePage) return
            window.animePage -= 1
            fetch_popular()
        })
    })

    function check_available_page() {
        if (window.animePage == 0) {
            $('#popular-prev').removeClass('available')
        } else {
            if (!$('#popular-prev').hasClass('available')) {
                $('#popular-prev').addClass('available')
            }
        }
    }

    function fetch_popular(limit=10) {
        const formData = {
            _token: "{{ csrf_token() }}",
            page: window.animePage,
            limit
        }
        $('#popular').html(`<div class="popular-item popular-load">
            <div class="lds-hourglass"></div>
        </div>`)
        $.ajax({
            url : "{{ route('fetch-popular') }}",
            type: "POST",
            data : formData,
            success: function(data, textStatus, jqXHR){
                let populars = ''
                for (const anime of data) {
                    var popular = `
                    <div class="popular-item">
                        <div class="popular-item__cover card">
                            <a target="_blank" href="{{ route('episodes', ['anime_id'=>'id_anime', 'episode_id'=>'0']) }}">
                                <img onerror="this.src = '{{ url('assets/img/logo/2.png') }}'" src="${anime.imageCover}" class="popular-item__img">
                            </a>
                        </div>
                        <div class="popular-item__info">
                            <a target="_blank" href="{{ route('detail-anime', ['id'=>'id_anime']) }}" class="popular-item__title">${anime.title}</a>
                            <span class="popular-item__description">${anime.tahun} | Eps. ${anime.episode} |
                                ${anime.rating}</span>
                        </div>
                    </div>
                    `
                    popular = popular.replace(/id_anime/g, anime.id)
                    populars += popular
                }
                $('#popular').html(populars)
                check_available_page()
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Toast.fire('Terdapat kesalahan', 'Gagal mengambil data populer.', 'warning')
            }
        });
    }
</script>
<script>
    window.commentPage = 0
    window.commentAscending = 0

    $(document).ready(function() {

        fetch_comment();

        $('main').scroll(function() {
            var scrollTop = Math.round($(this).scrollTop())
            var windowHeight = $(this).get(0).scrollHeight - $(this).get(0).clientHeight
            console.log({scrollTop, windowHeight})
            if(scrollTop >= windowHeight) {
                fetch_comment();
            }
        })

        // setInterval(() => {
        //     fetch_comment()
        // }, 60_000);

        $("textarea#input--comment").on('change keyup paste', function() {
            const text = $(this).val();
            const classText = 'disabled';
            if (text) {
                if ($('#post--button').hasClass(classText)) {
                    $('#post--button').removeClass(classText)
                }
            } else {
                if (!$('#post--button').hasClass(classText)) {
                    $('#post--button').addClass(classText)
                    $('#input--comment').data('parent_id', 0)
                }
            }
        });

        $('#post--button').on('click', function() {
            send_comment()
        })

        $('#input--comment').keydown(function (e) {
            if (e.ctrlKey && e.keyCode == 13) {
                send_comment()
            }
        });

        $("textarea#input--comment").on('change keyup paste', function() {
            const text = $(this).val();
            const classText = 'disabled';
            if (text) {
                if ($('#post--button').hasClass(classText)) {
                    $('#post--button').removeClass(classText)
                }
            } else {
                if (!$('#post--button').hasClass(classText)) {
                    $('#post--button').addClass(classText)
                }
            }
        });
    })

    function send_comment() {
        post_comment()
        $('textarea#input--comment').val('')
        $('#post--button').addClass('disabled')
    }
    
    const render_comment = (data) => {
        const comments = data.result
        const dataPage = Number(data.page)
        window.commentCount = data.length
        $('#comment--title').text(window.commentCount + ' Komentar')
        if (comments.length > 0 && dataPage == window.commentPage) {
            window.commentPage += 1
            for (let i = 0; i < comments.length; i++) {
                const comment = comments[i];
                const comment_content = comment.content.replace(/@([^ ]+)/g, '<a href="#comment-'+comment.parent_id+'" class="comment-reply">@$1</a>').replace(/_/g, ' ')
                var comment_box = `<div id="comment-${ comment.comment_id }" class="comments-box">
                    <div class="comments-box__content">
                        <div class="comment">
                            <div class="user-avatar">
                                <img src="${ comment.picture ? ('{{ url("profiles") }}/' + comment.picture) : '{{ url("assets/img/icons/profile.jpg") }}' }">
                            </div>
                            <div class="comment-content">
                                <div class="user-info">
                                    <h4>${ comment.name }</h4>
                                    <span class="comment-date">${ timeSince(Date.now() - (Date.now()-new Date(comment.created_at))) }</span>
                                    ${ comment.user_id == {{ Auth::check() ? Auth::user()->user_id : '0'}} ? `<a class="delete-button" onclick="delete_comment(${comment.comment_id})">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>` : ''}
                                </div>
                                <p class="comment-text">${ comment_content }</p>
                                <div class="comment-actions">
                                    <a class="like_comment ${comment.liked ? 'active' : ''}" onclick="send_like(${ comment.comment_id })">
                                        <i class="fa-${comment.liked ? 'solid' : 'regular'} fa-heart"></i>
                                        <span>&nbsp;${ comment.like_count }</span>
                                    </a>
                                    <a class="like_comment" onclick="reply_comment(${ comment.comment_id }, \`${ comment.name.replace(/ +/g, '_') }\`)">
                                        <i class="fa-regular fa-comment-dots"></i>
                                        <span>&nbsp; Balas</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`
                $('.users__comment--content').append(comment_box)
            }
        } else {
            if (window.commentPage == 0) {
                let empty_comment = `
                <div class="comments-box">
                    <div class="comments-box__content mt--30" style="text-align: center;">
                            <span>Tidak ada komentar</span>
                    </div>
                </div>
                `
                $('.users__comment--content').html(empty_comment)
            }
        }
    }

    function reply_comment(id, name) {
        $('#input--comment').data('parent_id', id)
        $('#input--comment').val($('#input--comment').val() + '@' + name + ' ')
        $('#input--comment').focus()
    }

    function send_like(comment_id) {
        @guest
            need_login('{{ route("login") }}')
            return
        @endguest
        const isLiked = $(`#comment-${ comment_id } .like_comment`).hasClass('active')
        post_like(comment_id, !isLiked)
    }

    function delete_comment(id) {
        post_delete_comment(id)
    }

    function ascending_comment(mode) {
        /*
            0: Best
            1: Latest
        */
        if (mode == 0) {
            $('.comment-best').addClass('active')
            $('.comment-latest').removeClass('active')
        } else {
            $('.comment-best').removeClass('active')
            $('.comment-latest').addClass('active')
        }
        window.commentPage = 0
        window.commentAscending = mode
        $('.users__comment--content').html('')
        fetch_comment()
    }

    function fetch_comment() {
        const formData = {
            _token: "{{ csrf_token() }}",
            anime_id: anime_id,
            episode_id: episode_id,
            page: window.commentPage,
            ascending: window.commentAscending
        }
        $.ajax({
            url : "{{ route('fetch-comment') }}",
            type: "POST",
            data : formData,
            success: function(data, textStatus, jqXHR){
                render_comment(data)
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Toast.fire('Terdapat kesalahan', 'Gagal mengambil data komentar.', 'warning')
            }
        });
    }

    function post_comment() {
        const parent_id = $('#input--comment').data('parent_id')
        const formData = {
            _token: "{{ csrf_token() }}",
            anime_id: anime_id,
            episode_id: episode_id,
            parent_id: parent_id,
            content: $('#input--comment').val(),
        }
        $.ajax({
            url : "{{ route('post-comment') }}",
            type: "POST",
            data : formData,
            success: function(data, textStatus, jqXHR){
                $('#input--comment').data('parent_id', 0)
                window.commentPage = 0
                $('.users__comment--content').html('')
                fetch_comment()
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Toast.fire('Terdapat kesalahan', 'Gagal mengambil data komentar.', 'warning')
            }
        });
    }
    
    function post_like(comment_id, is_like) {
        const formData = {
            _token: "{{ csrf_token() }}",
            comment_id: comment_id,
            is_like: is_like
        }
        $.ajax({
            url : "{{ route('post-like') }}",
            type: "POST",
            data : formData,
            success: function(data, textStatus, jqXHR){
                window.commentPage = 0
                $('.users__comment--content').html('')
                fetch_comment()
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Toast.fire('Terdapat kesalahan', 'Gagal mengambil data komentar.', 'warning')
            }
        });
    }

    async function post_delete_comment(id) {
        const formData = {
            _token: "{{ csrf_token() }}",
            id
        }
        $.ajax({
            url : "{{ route('delete-comment') }}",
            type: "POST",
            data : formData,
            success: function(data, textStatus, jqXHR){
                Toast.fire('Berhasil', 'Komentar Berhasil dihapus.', 'success')
                window.commentPage = 0
                $('.users__comment--content').html('')
                fetch_comment()
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Toast.fire('Terdapat kesalahan', 'Gagal menghapus komentar.', 'warning')
            }
        });
    }
</script>
<script>
    function save_bookmark(el) {
        @guest
            return need_login("{{ route('login') }}");
        @endguest
        const is_bookmark = $(el).data('bookmark');
        post_bookmark(is_bookmark).then(() => {
            if (is_bookmark) {
                $('.bookmark-area').html(`
                <div class="bookmark-button">
                    <i class="fa-regular fa-bookmark fa-2xl"></i>
                    <i class="fa-solid fa-plus fa-sm"></i>
                </div>`)
                $(el).data('bookmark', 0);
            } else {
                $('.bookmark-area').html(`
                <div class="bookmark-button-active">
                    <i class="fa-solid fa-bookmark fa-2xl"></i>
                    <i class="fa-regular fa-circle-check fa-sm"></i>
                </div>`)
                $(el).data('bookmark', 1);
            }
        })
    }

    async function post_bookmark(is_bookmark) {
        const formData = {
            _token: "{{ csrf_token() }}",
            anime_id: {{ $anime->id }},
            is_bookmark: is_bookmark
        }
        $.ajax({
            url : "{{ route('post-bookmark') }}",
            type: "POST",
            data : formData,
            success: function(data, textStatus, jqXHR){
                if (!is_bookmark) {
                    Toast.fire('Berhasil', 'Bookmark Berhasil ditambahkan.', 'success')
                } else {
                    Toast.fire('Berhasil', 'Bookmark Berhasil dihapus.', 'success')
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Toast.fire('Terdapat kesalahan', 'Gagal menyimpan bookmark.', 'warning')
            }
        });
    }
</script>
<script>
    $(document).ready(function () { 
        $('title').text('Xnime - {!! htmlspecialchars_decode(htmlspecialchars_decode(html_entity_decode($anime->title))) !!}');
    })
</script>
@endsection