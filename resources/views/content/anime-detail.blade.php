@extends('layout.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('detail-anime', $anime) }}
@endsection

@section('content')
<main class="main">
    <section class="section single-anime">
        <div class="anime-summary">
            <div class="anime-summary__cover">
                <img src="{{ $anime->image_cover }}" class="anime-summary__img">
            </div>
            <div class="anime-summary__info">
                <h1 class="anime-summary__title">{{ html_entity_decode($anime->title) }}</h1>
                <span class="anime__language-box">{{ $anime->rating }}</span>
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
                <p>{{ html_entity_decode($anime->content) }}</p>
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
        <div class="anime-episodes">
            @foreach ($anime->episodes as $episode)
            <div class="anime-episodes__item">
                <div class="anime-episodes__episode">
                    <a href="{{ route('episodes', ['anime_id'=>$anime->id, 'episode_id'=>$episode->id]) }}"
                        class="episode__link">#{{ $episode->episode }}</a>
                </div>
                <span class="anime-episodes__division"></span>
                <div class="anime-episodes__info">
                    <a href="{{ route('episodes', ['anime_id'=>$anime->id, 'episode_id'=>$episode->id]) }}"
                        class="anime-episodes__title">Episode {{ $episode->episode }}</a>
                    <span class="anime-episodes__date">{{ $episode->episode_lanjutan ? "Episode lanjutan:
                        ".$episode->episode_lanjutan : '' }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</main>
@endsection