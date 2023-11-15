<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
                    $video_url = explode("=", $serverurl)[0]."=dv";
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

        $data = array(
            'anime' => $animeDetail,
            'anime_list' => $animeList,
            'episode_id' => $episode_id,
            'server_list' => $server_list,
            'server_id' => $server_id,
            'video_url' => $video_url,
            'video_type' => $video_type
        );
        return view('content.episode')->with($data);
    }
}
