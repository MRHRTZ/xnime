<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $genreList = getGenres();
        $homepage = getHomepage();
        $data = array(
            'genres' => $genreList,
            'homepage' => $homepage
        );
        return view('content.home')->with($data);
    }
}
