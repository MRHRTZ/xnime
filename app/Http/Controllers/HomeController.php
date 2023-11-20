<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $genreList = getGenres();
        $homepage = getHomepage();

        $history_list = null;
        if (Auth::check()) {
            $history_list = History::getBookmark(Auth::user());
        }

        $data = array(
            'genres' => $genreList,
            'homepage' => $homepage,
            'history_list' => $history_list
        );
        return view('content.home')->with($data);
    }
}
