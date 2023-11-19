@extends('layout.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render('anime') }}
@endsection

@section('content')
<main class="main">
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
                                <input type="radio" name="jenisanime" value="0" {{ $jenisanime == "0" ? "checked" : "" }}>
                                <span class="radio"></span>
                            </label>
                            <label class="label-radio">Series
                                <input type="radio" name="jenisanime" value="1" {{ $jenisanime == "1" ? "checked" : "" }}>
                                <span class="radio"></span>
                            </label>
                            <label class="label-radio">Movie
                                <input type="radio" name="jenisanime" value="3" {{ $jenisanime == "3" ? "checked" : "" }}>
                                <span class="radio"></span>
                            </label>
                            <label class="label-radio">Live Action
                                <input type="radio" name="jenisanime" value="4" {{ $jenisanime == "4" ? "checked" : "" }}>
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
                                <input type="radio" name="genre" value="{{ $genreItem->id }}" {{ $genre == $genreItem->id ? "checked" : "" }}>
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
                                <input type="radio" name="sort" value="1" {{ $sort == "1" ? "checked" : "" }}>
                                <span class="radio"></span>
                            </label>
                            <label class="label-radio">Abjad A-z
                                <input type="radio" name="sort" value="2" {{ $sort == "2" ? "checked" : "" }}>
                                <span class="radio"></span>
                            </label>
                            <label class="label-radio">Abjad Z-a
                                <input type="radio" name="sort" value="3" {{ $sort == "3" ? "checked" : "" }}>
                                <span class="radio"></span>
                            </label>
                            <label class="label-radio">Tahun terbaru
                                <input type="radio" name="sort" value="4" {{ $sort == "4" ? "checked" : "" }}>
                                <span class="radio"></span>
                            </label>
                            <label class="label-radio">Tahun terlama
                                <input type="radio" name="sort" value="5" {{ $sort == "5" ? "checked" : "" }}>
                                <span class="radio"></span>
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="button">Terapkan Filter</button>
                </form>
            </div>
        </aside>
        <section class="section anime-list">
            <h1 class="section__title">List Anime</h1>
            @if (count($animeList) == 0)
                <div class="datasheet__td">
                    Data tidak ditemukan.
                </div>
            @endif
            @foreach ($animeList as $anime)
            <div class="anime-list__item card">
                <div class="anime-list__cover">
                    <a href="{{ route('detail-anime', ['id'=>$anime->id]) }}">
                        <img src="{{ $anime->imageCover }}" class="anime-list__img">
                    </a>
                </div>
                <div class="anime-list__info">
                    <a href="{{ route('detail-anime', ['id'=>$anime->id]) }}" class="anime-list__title">{!! htmlspecialchars_decode(htmlspecialchars_decode(html_entity_decode($anime->title)))
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
                                    <a href="{{ route('anime', ['page'=>$pageNow-1,'jenisanime'=>$jenisanime,'genre'=>$genre,'sort'=>$sort]) }}" class="pagination__link">«</a>
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
                            <a href="{{ route('anime', ['page'=>$pageNow+1,'jenisanime'=>$jenisanime,'genre'=>$genre,'sort'=>$sort]) }}" class="pagination__link">»</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </section>
    </div>
</main>
@endsection