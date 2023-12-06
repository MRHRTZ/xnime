@extends('layout.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('anime') }}
@endsection

@section('content')
<div class="wrapper mt--none">
    <aside class="aside filter">
        <h1 class="aside__title">Filter</h1>
        <div class="aside__box card">
            <form action="{{ route('anime') }}" method="get">
                <div class="filter__item">
                    <div class="filter__heading collapsible">
                        <h1 class="filter__title">Tipe</h1>
                        <span class="filter__chevron --toggle-down"></span>
                    </div>
                    <div class="filter__options">
                        <label class="label-radio">Update terbaru
                            <input type="radio" name="jenisanime" value="0" {{ $jenisanime=="0" ? "checked" : "" }}>
                            <span class="radio"></span>
                        </label>
                        <label class="label-radio">Series
                            <input type="radio" name="jenisanime" value="1" {{ $jenisanime=="1" ? "checked" : "" }}>
                            <span class="radio"></span>
                        </label>
                        <label class="label-radio">Movie
                            <input type="radio" name="jenisanime" value="3" {{ $jenisanime=="3" ? "checked" : "" }}>
                            <span class="radio"></span>
                        </label>
                        <label class="label-radio">Live Action
                            <input type="radio" name="jenisanime" value="4" {{ $jenisanime=="4" ? "checked" : "" }}>
                            <span class="radio"></span>
                        </label>
                    </div>
                </div>
                <div class="filter__item">
                    <div class="filter__heading collapsible">
                        <h1 class="filter__title">Genre</h1>
                        <span class="filter__chevron --toggle-down"></span>
                    </div>
                    <div class="filter__options">
                        @foreach ($genreList as $genreItem)
                        <label class="label-radio">{{ $genreItem->title }}
                            <input type="radio" name="genre" value="{{ $genreItem->id }}" {{ $genre==$genreItem->id
                            ? "checked" : "" }}>
                            <span class="radio"></span>
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="filter__item">
                    <div class="filter__heading collapsible">
                        <h1 class="filter__title">Urutkan</h1>
                        <span class="filter__chevron --toggle-down"></span>
                    </div>
                    <div class="filter__options">
                        <label class="label-radio">Rating
                            <input type="radio" name="sort" value="1" {{ $sort=="1" ? "checked" : "" }}>
                            <span class="radio"></span>
                        </label>
                        <label class="label-radio">Abjad A-z
                            <input type="radio" name="sort" value="2" {{ $sort=="2" ? "checked" : "" }}>
                            <span class="radio"></span>
                        </label>
                        <label class="label-radio">Abjad Z-a
                            <input type="radio" name="sort" value="3" {{ $sort=="3" ? "checked" : "" }}>
                            <span class="radio"></span>
                        </label>
                        <label class="label-radio">Tahun terbaru
                            <input type="radio" name="sort" value="4" {{ $sort=="4" ? "checked" : "" }}>
                            <span class="radio"></span>
                        </label>
                        <label class="label-radio">Tahun terlama
                            <input type="radio" name="sort" value="5" {{ $sort=="5" ? "checked" : "" }}>
                            <span class="radio"></span>
                        </label>
                    </div>
                </div>
                <div class="filter-button">
                    <button type="submit" class="button">Terapkan Filter</button>
                    <button type="button" class="clear-filter">
                        <i class="fa-solid fa-broom"></i>
                    </button>
                </div>
            </form>
        </div>
    </aside>
    <section class="section anime-list">
        <h1 class="section__title mb--20">List Anime</h1>
        @if (count($animeList) == 0)
        <div class="datasheet__td">
            Data tidak ditemukan.
        </div>
        @endif
        @foreach ($animeList as $anime)
        <div class="anime-list__item card">
            <div class="anime-list__cover">
                @auth
                @php
                $history = findObjectByCustomId($history_list, $anime->id, 'anime_id');
                @endphp
                @endauth
                @if (isset($history))
                @if ($history)
                <a target="_self"
                    href="{{ route('episodes', ['anime_id'=>$history->anime_id,'episode_id'=>$history->episode_id,'server_id'=>$history->server_id]) }}">
                    <img onerror="this.src = '{{ url('assets/img/logo/2.png') }}'" src="{{ $anime->imageCover }}"
                        class="anime-list__img">
                </a>
                <a target="_self"
                    href="{{ route('episodes', ['anime_id'=>$history->anime_id,'episode_id'=>$history->episode_id,'server_id'=>$history->server_id]) }}"
                    class="play__circle">
                    <i class="fa-solid fa-play play__icon"></i>
                </a>
                @else
                <a target="_self" href="{{ route('episodes', ['anime_id'=>$anime->id,'episode_id'=>'0']) }}">
                    <img onerror="this.src = '{{ url('assets/img/logo/2.png') }}'" src="{{ $anime->imageCover }}"
                        class="anime-list__img">
                </a>
                <a target="_self" href="{{ route('episodes', ['anime_id'=>$anime->id,'episode_id'=>'0']) }}"
                    class="play__circle">
                    <i class="fa-solid fa-play play__icon"></i>
                </a>
                @endif
                @else
                <a target="_self" href="{{ route('episodes', ['anime_id'=>$anime->id,'episode_id'=>'0']) }}">
                    <img onerror="this.src = '{{ url('assets/img/logo/2.png') }}'" src="{{ $anime->imageCover }}"
                        class="anime-list__img">
                </a>
                <a target="_self" href="{{ route('episodes', ['anime_id'=>$anime->id,'episode_id'=>'0']) }}"
                    class="play__circle">
                    <i class="fa-solid fa-play play__icon"></i>
                </a>
                @endif
            </div>
            <div class="anime-list__info">
                <a target="_self" href="{{ route('detail-anime', ['id'=>$anime->id]) }}" class="anime-list__title">{!!
                    htmlspecialchars_decode(htmlspecialchars_decode(html_entity_decode($anime->title)))
                    !!}</a>
                <br>
                <table class="datasheet__table">
                    <tr class="datasheet__tr">
                        <td class="datasheet__td">Status:</td>
                        <td class="datasheet__td">
                            @if ($anime->statusTayang == '1')
                            Ongoing
                            @elseif ($anime->statusTayang == '2')
                            Complete
                            @endif
                        </td>
                    </tr>
                    <tr class="datasheet__tr">
                        <td class="datasheet__td">Rating:</td>
                        <td class="datasheet__td">{{ $anime->rating }}</td>
                    </tr>
                    <tr class="datasheet__tr">
                        <td class="datasheet__td">Tahun:</td>
                        <td class="datasheet__td">{{ $anime->tahun }}</td>
                    </tr>
                    <tr class="datasheet__tr">
                        <td class="datasheet__td">Episode:</td>
                        <td class="datasheet__td">{{ $anime->episode }}</td>
                    </tr>
                </table>
            </div>
        </div>
        @endforeach
        <nav class="pagination">
            <div class="pagination__container">
                <ul class="pagination__list">
                    <li class="pagination__item">
                        @if ($pageNow == 1)
                        <span class="pagination__link box--false">«<span>
                                @else
                                <a href="{{ route('anime', ['page'=>$pageNow-1,'jenisanime'=>$jenisanime,'genre'=>$genre,'sort'=>$sort]) }}"
                                    class="pagination__link">«</a>
                                @endif
                    </li>
                    <li class="pagination__item">
                        <a href="#" class="pagination__link box--active">{{ $pageNow }}</a>
                    </li>
                    @if (count($animeList) == 0)
                    <li class="pagination__item">
                        <a href="#" class="pagination__link box--false">»</a>
                    </li>
                    @else
                    <li class="pagination__item">
                        <a href="{{ route('anime', ['page'=>$pageNow+1,'jenisanime'=>$jenisanime,'genre'=>$genre,'sort'=>$sort]) }}"
                            class="pagination__link">»</a>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>
    </section>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () { 
        $('title').text('Daftar Anime | Xnime ID');
    })
</script>
@endsection