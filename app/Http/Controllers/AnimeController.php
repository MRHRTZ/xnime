<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnimeController extends Controller
{
    public function index(Request $request) {
        $pageNow = $request->query('page') ?? 1;
        $filterJenisAnime = $request->query('jenisanime') ?? '';
        $filterGenre = $request->query('genre') ?? '';
        $filterSort = $request->query('sort') ?? '';

        $history_list = null;
        if (Auth::check()) {
            $history_list = History::getHistory(Auth::user());
        }

        $animeList = getListAnime(15, $pageNow-1, $filterGenre, $filterJenisAnime, $filterSort);
        $genreList = getGenres();
        $data = array(
            'pageNow' => $pageNow,
            'animeList' => $animeList,
            'genreList' => $genreList,
            'jenisanime' => $filterJenisAnime,
            'genre' => $filterGenre,
            'sort' => $filterSort,
            'history_list' => $history_list
        );
        return view('content.anime')->with($data);
    }

    public function detail(Request $request) {
        $id = $request->query('id');
        $animeDetail = getAnimeDetail($id);
        $animeDetail->episodes = array_reverse($animeDetail->episodes);
        
        $history = [];
        $bookmark = null;

        if (Auth::check())  {
            $user = Auth::user();
            $history = History::where('user_id', $user->user_id)
            ->where('anime_id', $id)
            ->get();

            $bookmark = Bookmark::where('user_id', $user->user_id)
            ->where('anime_id', $id)
            ->first();
        }

        $data = array(
            'anime' => $animeDetail,
            'history' => $history,
            'bookmark' => $bookmark
        );

        return view('content.anime-detail')->with($data);
    }
    
    public function search(Request $request) {
        $keyword = $request->query('q');
        $page = $request->query('page') ?? 1;
        $animeList = searchAnime(15, $page-1, $keyword);
        $data = array(
            'animeList' => $animeList,
            'keyword' => $keyword,
            'page' => $page
        );
        return view('content.search')->with($data);
    }

    public function schedule() {
        $days = getDays();
        $homepage = getHomepage();

        $history_list = null;
        if (Auth::check()) {
            $history_list = History::getHistory(Auth::user());
        }

        $data = array(
            'days' => $days,
            'schedules' => $homepage->schedule,
            'history_list' => $history_list
        );
        return view('content.schedule')->with($data);
    }
}
