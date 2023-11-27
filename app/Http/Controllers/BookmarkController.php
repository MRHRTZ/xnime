<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Bookmark;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class BookmarkController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $history_data = History::getHistory($user);
            $bookmark_data = Bookmark::getBookmark($user);
            $data = array(
                'history_data' => $history_data,
                'bookmark_data' => $bookmark_data
            );
            return view('content.bookmark')->with($data);
        } else {
            return redirect()->back();
        }
    }

    public function post_bookmark(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $is_bookmark = $request->input('is_bookmark');
            $anime_id = $request->input('anime_id');
            if ($is_bookmark == '0') {
                if (!Anime::find($anime_id)) {
                    $animeDetail = getAnimeDetail($anime_id);
                    Anime::create([
                        'anime_id' => $animeDetail->id,
                        'title' => $animeDetail->title,
                        'image' => $animeDetail->image_cover,
                        'year' => $animeDetail->tahun,
                        'rating' => $animeDetail->rating,
                        'total_episode' => $animeDetail->total_episode,
                    ]);
                }
                Bookmark::create([
                    'anime_id' => $anime_id,
                    'user_id' => $user->user_id
                ]);
            } else {
                Bookmark::where('anime_id', $anime_id)
                    ->where('user_id', $user->user_id)
                    ->delete();
            }
            return Response::json('Ok');
        } else {
            return Response::json('Unauthorized', 403);
        }
    }

    function delete_history(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $id = $request->input('id');
            $history = History::find($id);
            if ($history->user_id == $user->user_id) {
                $history->delete();
                return Response::json('Ok');
            } else {
                return Response::json('Unauthorized', 403);
            }
        } else {
            return Response::json('Unauthorized', 403);
        }
    }

    function delete_bookmark(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $id = $request->input('id');
            $bookmark = Bookmark::find($id);
            if ($bookmark->user_id == $user->user_id) {
                $bookmark->delete();
                return Response::json('Ok');
            } else {
                return Response::json('Unauthorized', 403);
            }
        } else {
            return Response::json('Unauthorized', 403);
        }
    }
}
