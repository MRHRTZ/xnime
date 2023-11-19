<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookmarkController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();

            $history_data = DB::table('history')
                ->select('anime.title', 'anime.image', 'history.*', DB::raw('(history.play_time / history.max_time * 100) as progress'))
                ->join(
                    DB::raw('(SELECT anime_id, MAX(episode) AS max_episode
                            FROM history GROUP BY anime_id) history_sub'),
                    function ($cond) {
                        $cond->on('history.anime_id', 'history_sub.anime_id');
                        $cond->where('history.episode', DB::raw('history_sub.max_episode'));
                    }
                )
                ->join('anime', 'anime.anime_id', '=', 'history.anime_id')
                ->where('user_id', '=', $user->user_id)
                ->get();

            $data = array(
                'history_data' => $history_data
            );
            return view('content.bookmark')->with($data);
        } else {
            return redirect()->back();
        }
    }
}
