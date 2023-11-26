@extends('layout.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('detail-anime', $anime) }}
@endsection

@section('content')
<main class="main">
    <section class="section single-anime">
        <div class="anime-summary card">
            <div class="anime-summary__cover">
                <img onerror="this.src = '{{ url('assets/img/logo/2.png') }}'" src="{{ $anime->image_cover }}"
                    class="anime-summary__img">
            </div>
            <div class="anime-summary__info">
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
                <h1 class="anime-summary__title">{!!
                    htmlspecialchars_decode(htmlspecialchars_decode(html_entity_decode($anime->title))) !!}</h1>
                <span class="anime__language-box"><i class="fa-regular fa-star" class="rating"></i> {{ $anime->rating
                    }}</span>
                <ul class="anime-genres__list">
                    @foreach ($anime->categories as $genre)
                    <li class="anime-genres__item">
                        <a href="{{ route('anime', ['genre'=>$genre->cat_id]) }}" class="anime-genres__link">{{
                            $genre->title }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="anime-summary__synopsis">
                <p>{!! htmlspecialchars_decode(htmlspecialchars_decode(html_entity_decode($anime->content)))!!}</p>
                <br>
                <table class="datasheet__table">
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
    </section>
    <section class="section episodes mt--40">
        <h1 class="section__title">Episode</h1>
        <div class="anime-episodes card">
            @foreach ($anime->episodes as $episode)
            <a class="anime-episodes__item episode__link"
                href="{{ route('episodes', ['anime_id'=>$anime->id, 'episode_id'=>$episode->id]) }}">
                {{ $episode->episode }}
                <span class="anime-episodes-time">
                    @foreach ($history as $hist)
                    {{ $hist->episode_id == $episode->id ? secondToTime($hist->play_time) : ''}}
                    @endforeach
                </span>
            </a>
            @endforeach

    </section>
</main>
@endsection

@section('script')
<script>
    $(document).ready(function () { 
        $('title').text('Xnime - Detail {!! htmlspecialchars_decode(htmlspecialchars_decode(html_entity_decode($anime->title))) !!}');
    })
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
@endsection