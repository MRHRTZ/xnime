@extends('layout.master')

@section('content')
<div class="wrapper mt--none">
    <section class="section anime-list">
        <h1 class="section__title">Hasil Pencarian:</h1>
        <div class="search-box">
            <form action="{{ route('search', ['page'=>$page]) }}" class="search-box__form">
                <input type="text" class="search-box__input" name="q" value="{{ $keyword }}">
                <button type="submit" class="search-box__button">
                    <i class="fa-solid fa-magnifying-glass search-box__icon"></i>
                </button>
            </form>
        </div>
        @if (count($animeList) == 0)
        <div class="datasheet__td">
            Data tidak ditemukan.
        </div>
        @endif
        @foreach ($animeList as $anime)
        <div class="anime-list__item card">
            @auth
            @php
            $history = findObjectByCustomId($history_list, $anime->id, 'episode_id');
            @endphp
            @endauth

            <div class="anime-list__cover">
                @if (isset($history))
                @if ($history)
                <a target="_blank"
                    href="{{ route('episodes', ['anime_id'=>$history->anime_id,'episode_id'=>$history->episode_id,'server_id'=>$history->server_id]) }}">
                    <img onerror="this.src = '{{ url('assets/img/logo/2.png') }}'" src="{{ $anime->imageCover }}"
                        class="anime-list__img" alt="">
                </a>
                @else
                <a target="_blank" href="{{ route('episodes', ['anime_id'=>$anime->id, 'episode_id'=>'0']) }}">
                    <img onerror="this.src = '{{ url('assets/img/logo/2.png') }}'" src="{{ $anime->imageCover }}"
                        class="anime-list__img" alt="">
                </a>
                @endif
                @else
                <a target="_blank" href="{{ route('episodes', ['anime_id'=>$anime->id, 'episode_id'=>'0']) }}">
                    <img onerror="this.src = '{{ url('assets/img/logo/2.png') }}'" src="{{ $anime->imageCover }}"
                        class="anime-list__img" alt="">
                </a>
                @endif
            </div>
            <div class="anime-list__info">
                <a target="_blank" href="{{ route('detail-anime', ['id'=>$anime->id]) }}" class="anime-list__title">{{
                    $anime->title
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
@endsection

@section('script')
<script>
    $(document).ready(function () { 
        $('title').text('Xnime - Cari anime {{ $keyword }}');
    })
</script>
@endsection