<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\History;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use stdClass;

class EpisodeController extends Controller
{
    public function index(Request $request)
    {
        $anime_id = $request->route('anime_id');
        $episode_id = $request->route('episode_id');
        $server_id = $request->query('server_id');
        $animeList = getListAnime();
        $animeDetail = getAnimeDetail($anime_id);
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

        $history_list = [];
        $history_data = null;
        $user_report = "false";

        if (Auth::check()) {
            $user = Auth::user();
            if (!Anime::where('anime_id', $anime_id)->exists()) {
                Anime::create([
                    'anime_id' => $animeDetail->id,
                    'title' => $animeDetail->title,
                    'image' => $animeDetail->image_cover,
                    'year' => $animeDetail->tahun,
                    'rating' => $animeDetail->rating,
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
        }

        $data = array(
            'anime' => $animeDetail,
            'anime_list' => $animeList,
            'episode_id' => $episode_id,
            'server_list' => $server_list,
            'server_id' => $server_id,
            'video_url' => $video_url,
            'video_type' => $video_type,
            'user_report' => $user_report,
            'history_data' => $history_data,
            'history_list' => $history_list,
        );
        return view('content.episode')->with($data);
    }


    public function report_broken(Request $request)
    {
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
                'episode' => $episode
            ]);
        } else {
            $history->server_id = $server_id;
            $history->play_time = $play_time;
            $history->max_time = $max_time;
            $history->save();
        }

        return 'Ok';
    }
}
