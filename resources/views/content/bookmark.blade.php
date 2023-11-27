@extends('layout.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('bookmark') }}
@endsection

@section('content')
<main class="main">
    <section class="recommend section featured mb--40">
        <h1 class="section__title">Riwayat</h1>
        @if ($history_data->count() > 0)
        <div class="history cards__container mt--10">
            @foreach ($history_data as $history)
            <div id="history-{{ $history->history_id }}" class="history-card card">
                <div class="history-card__thumbnail-box">
                    <a target="_blank"
                        href="{{ route('episodes', ['anime_id'=>$history->anime_id,'episode_id'=>$history->episode_id,'server_id'=>$history->server_id]) }}"><img
                            onerror="this.src = '{{ url('assets/img/logo/2.png') }}'" src="{{ $history->image }}"
                            class="history-card__thumbnail-img"></a>
                    <a target="_blank"
                        href="{{ route('episodes', ['anime_id'=>$history->anime_id,'episode_id'=>$history->episode_id,'server_id'=>$history->server_id]) }}"
                        class="play__circle">
                        <i class="fa-solid fa-play play__icon"></i>
                    </a>
                </div>
                <div class="history-card__progress">
                    <div id="progress-{{ $history->anime_id }}" class="progressbar">
                    </div>
                </div>
                <div class="history-card__info">
                    <a class="delete-button" onclick="delete_history({{ $history->history_id }})">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                    <p class="history-card__description mb--5"><b>Episode {{ $history->episode }}</b></p>
                    <a target="_blank" href="{{ route('detail-anime', ['id'=>$history->anime_id]) }}"
                        class="history-card__title">{!!
                        htmlspecialchars_decode(htmlspecialchars_decode(html_entity_decode($history->title))) !!}</a>
                </div>
            </div>
            @endforeach
            @else
            <div class="empty-message">
                <p>Tidak ada riwayat tontonan anime</p>
            </div>
            @endif
        </div>
    </section>
    <div class="wrapper mt--none">
        <section class="section cards">
            <h1 class="section__title">Bookmark</h1>
            @if ($bookmark_data->count() > 0)
            <div class="bookmark cards__container mt--10">
                @foreach ($bookmark_data as $bookmark)
                <div id="bookmark-{{ $bookmark->bookmark_id }}" class="bookmark-card card">
                    <div class="bookmark-card__thumbnail-box">
                        @if ($bookmark->history_id)
                        <a target="_blank"
                            href="{{ route('episodes', ['anime_id'=>$bookmark->anime_id,'episode_id'=>$bookmark->history_episode_id,'server_id'=>$bookmark->history_server_id]) }}"><img
                                onerror="this.src = '{{ url('assets/img/logo/2.png') }}'" src="{{ $bookmark->image }}"
                                class="bookmark-card__thumbnail-img"></a>
                        <a target="_blank"
                            href="{{ route('episodes', ['anime_id'=>$bookmark->anime_id,'episode_id'=>$bookmark->history_episode_id,'server_id'=>$bookmark->history_server_id]) }}"
                            class="play__circle">
                            <i class="fa-solid fa-play play__icon"></i>
                        </a>
                        @else
                        <a target="_blank"
                            href="{{ route('episodes', ['anime_id'=>$bookmark->anime_id,'episode_id'=>'0']) }}"><img
                                onerror="this.src = '{{ url('assets/img/logo/2.png') }}'" src="{{ $bookmark->image }}"
                                class="bookmark-card__thumbnail-img"></a>
                        <a target="_blank"
                            href="{{ route('episodes', ['anime_id'=>$bookmark->anime_id,'episode_id'=>'0']) }}"
                            class="play__circle">
                            <i class="fa-solid fa-play play__icon"></i>
                        </a>
                        @endif
                        <span class="bookmark-card__language-box">
                            <i class="fa-regular fa-star" class="rating"></i>&nbsp;{{ $bookmark->rating }}
                        </span>
                    </div>
                    <div class="bookmark-card__info">
                        <a class="delete-button" onclick="delete_bookmark({{ $bookmark->bookmark_id }})">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                        <p class="bookmark-card__description"><b>{{ $bookmark->year }}</b></p>
                        <a href="{{ route('detail-anime', ['id'=>$bookmark->anime_id]) }}"
                            class="episode-card__title">{!!
                            htmlspecialchars_decode(htmlspecialchars_decode(html_entity_decode($bookmark->title)))
                            !!}</a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-message">
                <p>Tidak ada bookmark tersimpan</p>
            </div>
            @endif
        </section>
    </div>
</main>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        @foreach ($history_data as $history)  
            $('#progress-{{ $history->anime_id }}').css('width', '{{ $history->progress }}%');
        @endforeach
    });
</script>
<script>
    var swiper = new Swiper('.mySwiper', {
    slidesPerView: 'auto',
    loop: true,
    loopFillGroupWithBlank: true,
    spaceBetween: 20,
    breakpoints: {
        320: { spaceBetween: 10 },
        480: { spaceBetween: 20 }
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    }
});
</script>
<script>
    $(document).ready(function () { 
        $('title').text('Xnime - Bookmark');
    })
</script>
<script>
    function delete_history(id) {
        post_delete_history(id).then(() => {
            $('#history-'+id).remove();
        })
    }
    
    function delete_bookmark(id) {
        post_delete_bookmark(id).then(() => {
            $('#bookmark-'+id).remove();
        })
    }

    async function post_delete_history(id) {
        const formData = {
            _token: "{{ csrf_token() }}",
            id
        }
        $.ajax({
            url : "{{ route('delete-history') }}",
            type: "POST",
            data : formData,
            success: function(data, textStatus, jqXHR){
                Toast.fire('Berhasil', 'Riwayat Berhasil dihapus.', 'success')
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Toast.fire('Terdapat kesalahan', 'Gagal menghapus bookmark.', 'warning')
            }
        });
    }

    async function post_delete_bookmark(id) {
        const formData = {
            _token: "{{ csrf_token() }}",
            id
        }
        $.ajax({
            url : "{{ route('delete-bookmark') }}",
            type: "POST",
            data : formData,
            success: function(data, textStatus, jqXHR){
                Toast.fire('Berhasil', 'Bookmark Berhasil dihapus.', 'success')
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Toast.fire('Terdapat kesalahan', 'Gagal menghapus bookmark.', 'warning')
            }
        });
    }
</script>
@endsection