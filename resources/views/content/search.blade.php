@extends('layout.master')

@section('content')
<main class="main">
    <div class="wrapper mt--none">
        <section class="section anime-list">
            <h1 class="section__title">Hasil Pencarian:</h1>
            <div class="search-box">
                <form action="{{ route('search', ['page'=>$page]) }}" class="search-box__form">
                    <input type="text" class="search-box__input" name="q" value="{{ $keyword }}">
                    <button type="submit" class="search-box__button">
                        <ion-icon name="search" class="search-box__icon"></ion-icon>
                    </button>
                </form>
            </div>
            @if (count($animeList) == 0)
            <div class="datasheet__td">
                Data tidak ditemukan.
            </div>
            @endif
            @foreach ($animeList as $anime)
            <div class="anime-list__item">
                <div class="anime-list__cover">
                    <a href="{{ route('detail-anime', ['id'=>$anime->id]) }}">
                        <img src="{{ $anime->imageCover }}" class="anime-list__img" alt="">
                    </a>
                </div>
                <div class="anime-list__info">
                    <a href="{{ route('detail-anime', ['id'=>$anime->id]) }}" class="anime-list__title">{{ $anime->title
                        }}</a>
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
                            @if ($page == 1)
                            <span class="pagination__link box--false">«<span>
                            @else
                            <a href="{{ route('search', ['page'=>$page-1,'q'=>$keyword]) }}"
                                class="pagination__link">«</a>
                            @endif
                        </li>
                        <li class="pagination__item">
                            <a href="#" class="pagination__link box--active">{{ $page }}</a>
                        </li>
                        @if (count($animeList) == 0)
                        <li class="pagination__item">
                            <a href="#" class="pagination__link box--false">»</a>
                        </li>
                        @else
                        <li class="pagination__item">
                            <a href="{{ route('search', ['page'=>$page+1,'q'=>$keyword]) }}" class="pagination__link">»</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </section>
    </div>
</main>
@endsection