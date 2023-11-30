<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Bookmark;
use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\History;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use stdClass;

class EpisodeController extends Controller
{
    public function index(Request $request)
    {
        $anime_id = $request->route('anime_id');
        $episode_id = $request->route('episode_id');
        $server_id = $request->query('server_id');
        $animeDetail = getAnimeDetail($anime_id);

        if ($episode_id == '0') {
            $episode_id = $animeDetail->episodes[0]->id;
        }

        $server_video = getServerList($anime_id, $episode_id);
        $server_list = array();

        foreach ($server_video->list as $server) {
            $obj_video = new stdClass();
            $obj_video->id = $server->id;
            $obj_video->server = $server->server . " [$server->quality]";
            $obj_video->size = $server->quality == "SD" ? 480 : 720;
            $obj_video->url = $server->url;
            array_push($server_list, $obj_video);
        }

        if ($server_id) {
            $serverdata = getServer($server_id);
            if (!$serverdata) {
                $serverdata = findObjectById($server_list, $server_id);
                if (str_contains($serverdata->url, '.mp4')) {
                    $video_url = $serverdata->url;
                    $video_type = "embed";
                } else {
                    $video_url = "";
                    $video_type = "broken";
                }
            } else {
                $serverurl = $serverdata->url;
                if (str_contains($serverurl, 'm3u8')) {
                    $video_url = $serverurl;
                    $video_type = "stream";
                } else if (str_contains($serverurl, '.my.id')) {
                    $video_url = $serverurl;
                    $video_type = "source";
                } else if (str_contains($serverurl, 'googleusercontent')) {
                    $video_url = explode("=", $serverurl)[0] . "=dv";
                    $video_type = "source";
                } else {
                    $video_url = $serverurl;
                    $video_type = "embed";
                }
            }
        } else {
            $server_id = $server_list[0]->id;
            if (str_contains($server_video->serverurl, 'blogspot')) {
                $video_url = getUrlVideo($server_video->serverurl)->url;
                $video_type = "source";
            } else if (str_contains($server_video->serverurl, 'm3u8')) {
                $video_url = $server_video->serverurl;
                $video_type = "stream";
            } else {
                $video_url = $server_video->serverurl;
                $video_type = "embed";
            }
        }

        if ($video_type == "embed") {
            $pattern = '/<iframe[^>]*src=[\'"]([^\'"]*)[\'"][^>]*>/';
            $string = getRequest($video_url);
            if (preg_match($pattern, $string, $matches)) {
                $srcValue = $matches[1];
                if ($srcValue) {
                    $video_url = $srcValue;
                    $video_type = "embed";
                } else {
                    $video_url = "";
                    $video_type = "broken";
                }
            }
        }

        $history_list = [];
        $history_data = null;
        $user_report = "false";
        $bookmark = null;

        if (Auth::check()) {
            $user = Auth::user();
            if (!Anime::where('anime_id', $anime_id)->exists()) {
                Anime::create([
                    'anime_id' => $animeDetail->id,
                    'title' => $animeDetail->title,
                    'image' => $animeDetail->image_cover,
                    'year' => $animeDetail->tahun,
                    'rating' => $animeDetail->rating,
                    'total_episode' => $animeDetail->total_episode
                ]);
            }

            $history_data = History::where('user_id', $user->user_id)
                ->where('anime_id', $anime_id)
                ->where('episode_id', $episode_id)
                ->first();

            $history_list = History::where('user_id', $user->user_id)
                ->where('anime_id', $anime_id)
                ->get();

            $report = Report::where('user_id', $user->user_id)
                ->where('anime_id', $anime_id)
                ->where('episode_id', $episode_id)
                ->where('server_id', $server_id ? $server_id : $server_list[0]->id)
                ->first();
            $user_report = $report ? "true" : "false";

            $bookmark = Bookmark::where('user_id', $user->user_id)
            ->where('anime_id', $anime_id)
            ->first();
        }

        $data = array(
            'anime' => $animeDetail,
            'episode_id' => $episode_id,
            'server_list' => $server_list,
            'server_id' => $server_id,
            'video_url' => $video_url,
            'video_type' => $video_type,
            'user_report' => $user_report,
            'history_data' => $history_data,
            'history_list' => $history_list,
            'bookmark' => $bookmark
        );
        return view('content.episode')->with($data);
    }


    public function report_broken(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $anime_id = $request->input('anime_id');
            $episode_id = $request->input('episode_id');
            $server_id = $request->input('server_id');
    
            Report::create([
                'user_id' => $user->user_id,
                'anime_id' => $anime_id,
                'episode_id' => $episode_id,
                'server_id' => $server_id
            ]);

            return redirect()->back();
        } else {
            return redirect()->route('beranda');
        }
    }

    public function update_history(Request $request)
    {
        $user = Auth::user();
        $anime_id = $request->input('anime_id');
        $episode_id = $request->input('episode_id');
        $server_id = $request->input('server_id');
        $play_time = $request->input('play_time');
        $max_time = $request->input('max_time');
        $episode = $request->input('episode');
        $is_ended = $play_time == $max_time ? 1 : 0;

        $history = History::where('user_id', $user->user_id)
            ->where('anime_id', $anime_id)
            ->where('episode_id', $episode_id)
            ->first();

        if (!$history) {
            History::updateOrCreate([
                'user_id' => $user->user_id,
                'anime_id' => $anime_id,
                'episode_id' => $episode_id,
                'server_id' => $server_id,
                'play_time' => $play_time,
                'max_time' => $max_time,
                'episode' => $episode,
                'is_ended' => $is_ended
            ]);
        } else {
            $history->server_id = $server_id;
            $history->play_time = $play_time;
            $history->max_time = $max_time;
            $history->is_ended = $is_ended;
            $history->save();
        }

        return 'Ok';
    }

    public function post_comment(Request $request)
    {
        $anime_id = $request->input('anime_id');
        $episode_id = $request->input('episode_id');
        $parent_id = $request->input('parent_id');
        $content = $request->input('content');

        if (Auth::check()) {
            $user = Auth::user();
            $user_comment = Comment::create([
                'user_id' => $user->user_id,
                'anime_id' => $anime_id,
                'episode_id' => $episode_id,
                'parent_id' => $parent_id,
                'content' => $content
            ]);
            $user_comment->name = $user->name;
            $user_comment->picture = $user->picture;
            $data = array(
                "status" => 200,
                "result" => $user_comment
            );
            return Response::json($data);
        } else {
            $data = array(
                "status" => 403
            );
            return Response::json($data);
        }
    }
    
    public function post_like(Request $request)
    {
        $comment_id = $request->input('comment_id');
        $is_like = $request->input('is_like') == 'true';

        if (Auth::check()) {
            $user = Auth::user();
            if ($is_like) {
                CommentLike::create([
                    'user_id' => $user->user_id,
                    'comment_id' => $comment_id,
                    'is_like' => $is_like
                ]);
            } else {
                CommentLike::where('user_id', $user->user_id)
                ->where('comment_id', $comment_id)
                ->delete();
            }
            $data = array(
                "status" => 200,
            );
            return Response::json($data);
        } else {
            $data = array(
                "status" => 403
            );
            return Response::json($data);
        }
    }

    public function fetch_comment(Request $request)
    {
        $anime_id = $request->input('anime_id');
        $episode_id = $request->input('episode_id');
        $page = $request->input('page') ?? 0;
        $limit = $request->input('limit') ?? 10;
        $ascending = $request->input('ascending') ?? 0;

        $data_comment = Comment::select('comment.*', 'users.username', 'users.picture', DB::raw('COALESCE(COUNT(comment_like.is_like), 0) AS like_count'));
        if (Auth::check()) {
            $user_id = Auth::user()->user_id;
            $data_comment->addSelect(DB::raw("EXISTS(SELECT 1 FROM comment_like WHERE comment_like.comment_id = comment.comment_id AND comment_like.user_id = $user_id LIMIT 1) as liked"));
        }
        $data_comment = $data_comment->join('users', 'users.user_id', '=', 'comment.user_id')
            ->leftJoin('comment_like', 'comment_like.comment_id', '=', 'comment.comment_id')
            ->where('anime_id', $anime_id)
            ->where('episode_id', $episode_id)
            ->groupBy('comment.comment_id')
            ->orderBy($ascending == 0 ? 'like_count' : 'created_at', 'desc')
            ->limit($limit)
            ->offset($page*$limit)
            ->get();

        $length_comment = Comment::where('anime_id', $anime_id)
        ->where('episode_id', $episode_id)->count();

        $data = array(
            "status" => 200,
            "page" => $page,
            "length" => $length_comment,
            "result" => $data_comment
        );

        return Response::json($data);
    }

    function delete_comment(Request $request) {
        if (Auth::check()) {
            $user = Auth::user();
            $id = $request->input('id');
            $comment = Comment::find($id);
            if ($comment->user_id == $user->user_id) {
                $comment->delete();
                return Response::json('Ok');
            } else {
                return Response::json('Unauthorized', 403);
            }
        } else {
            return Response::json('Unauthorized', 403);
        }
    }

    public function fetch_popular(Request $request) {
        $page = $request->input('page') ?? 0;
        $limit = $request->input('limit') ?? 10;
        $animeList = getListAnime($limit, $page*$limit);
        return Response::json($animeList);
    }
}
