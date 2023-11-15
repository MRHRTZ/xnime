<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AnimeController extends Controller
{
    public function index(Request $request) {
        $pageNow = $request->query('page') ?? 1;
        $filterJenisAnime = $request->query('jenisanime') ?? '';
        $filterGenre = $request->query('genre') ?? '';
        $filterSort = $request->query('sort') ?? '';

        $animeList = getListAnime(15, $pageNow-1, $filterGenre, $filterJenisAnime, $filterSort);
        $genreList = getGenres();
        $data = array(
            'pageNow' => $pageNow,
            'animeList' => $animeList,
            'genreList' => $genreList,
            'jenisanime' => $filterJenisAnime,
            'genre' => $filterGenre,
            'sort' => $filterSort
        );
        return view('content.anime')->with($data);
    }

    public function detail(Request $request) {
        $id = $request->query('id');
        $animeDetail = getAnimeDetail($id);
        $animeDetail->episodes = array_reverse($animeDetail->episodes);
        $data = array(
            'anime' => $animeDetail
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
        $data = array(
            'days' => $days,
            'schedules' => $homepage->schedule
        );
        return view('content.schedule')->with($data);
    }

    public function fetch_anime(Request $request) {
        $page = $request->query('page');
        $animeList = getListAnime(15, $page);
        return Response::json($animeList);
    }
}
