<?php

use GuzzleHttp\Client;

if (!function_exists('secondToTime')) {
    function secondToTime($seconds)
    {
        $t = round($seconds);
        return sprintf('%02d:%02d:%02d', ($t / 3600), ($t / 60 % 60), $t % 60);
    }
}

if (!function_exists('getDays')) {
    function getDays()
    {
        return array(
            array(
                "no" => "1",
                "day" => "Senin"
            ),
            array(
                "no" => "2",
                "day" => "Selasa"
            ),
            array(
                "no" => "3",
                "day" => "Rabu"
            ),
            array(
                "no" => "4",
                "day" => "Kamis"
            ),
            array(
                "no" => "5",
                "day" => "Jumat"
            ),
            array(
                "no" => "6",
                "day" => "Sabtu"
            ),
            array(
                "no" => "7",
                "day" => "Minggu"
            ),
            array(
                "no" => "8",
                "day" => "Acak"
            )
        );
    }
}

if (!function_exists('getGenres')) {
    function getGenres()
    {
        $baseurl = \config('vunime.baseurl');
        $apikey = \config('vunime.apikey');
        $client = new Client();
        $res = $client->request("GET", $baseurl . "/vunime/anime/genre", [
            "headers" => [
                "x-api-key" => $apikey,
            ]
        ]);
        $result = json_decode($res->getBody());
        return $result;
    }
}

if (!function_exists('getHomepage')) {
    function getHomepage()
    {
        $baseurl = \config('vunime.baseurl');
        $apikey = \config('vunime.apikey');
        $client = new Client();
        $res = $client->request("GET", $baseurl . "/vunime/pages/homepage", [
            "headers" => [
                "x-api-key" => $apikey,
            ]
        ]);
        $result = json_decode($res->getBody());
        return $result;
    }
}

if (!function_exists('searchAnime')) {
    function searchAnime($perpage = 15, $startpage = 0, $q = '')
    {
        try {
            $baseurl = \config('vunime.baseurl');
            $apikey = \config('vunime.apikey');
            $client = new Client();
            $res = $client->request("POST", $baseurl . "/vunime/anime/search", [
                "headers" => [
                    "x-api-key" => $apikey,
                ],
                "form_params" => [
                    'perpage' => $perpage,
                    'startpage' => $startpage == 0 ? 0 : $startpage * $perpage,
                    'q' => $q
                ]
            ]);
            $result = json_decode($res->getBody());
            return $result;
        } catch (\Throwable $th) {
            return array();
        }
    }
}

if (!function_exists('getListAnime')) {
    function getListAnime($perpage = 15, $startpage = 0, $genre = '', $jenisanime = '', $sort = '')
    {
        try {
            $baseurl = \config('vunime.baseurl');
            $apikey = \config('vunime.apikey');
            $client = new Client();
            $res = $client->request("POST", $baseurl . "/vunime/anime/list", [
                "headers" => [
                    "x-api-key" => $apikey,
                ],
                "form_params" => [
                    'perpage' => $perpage,
                    'startpage' => $startpage == 0 ? 0 : $startpage * $perpage,
                    'genre' => $genre,
                    'jenisanime' => $jenisanime,
                    'sort' => $sort,
                ]
            ]);
            $result = json_decode($res->getBody());
            return $result;
        } catch (\Throwable $th) {
            return array();
        }
    }
}


if (!function_exists('getAnimeDetail')) {
    function getAnimeDetail($id)
    {
        try {
            $baseurl = \config('vunime.baseurl');
            $apikey = \config('vunime.apikey');
            $client = new Client();
            $res = $client->request("POST", $baseurl . "/vunime/anime/detail", [
                "headers" => [
                    "x-api-key" => $apikey,
                ],
                "form_params" => [
                    'id' => $id
                ]
            ]);
            $result = json_decode($res->getBody());
            return $result;
        } catch (\Throwable $th) {
            return array();
        }
    }
}

if (!function_exists('getServerList')) {
    function getServerList($id_anime, $id_episode)
    {
        try {
            $baseurl = \config('vunime.baseurl');
            $apikey = \config('vunime.apikey');
            $userid = \config('vunime.userid');
            $client = new Client();
            $res = $client->request("POST", $baseurl . "/vunime/anime/get-server-list", [
                "headers" => [
                    "x-api-key" => $apikey,
                ],
                "form_params" => [
                    'animeID' => $id_anime,
                    'id' => $id_episode,
                    'userId' => $userid,
                ]
            ]);
            $result = json_decode($res->getBody());
            return $result;
        } catch (\Throwable $th) {
            return array();
        }
    }
}

if (!function_exists('getServer')) {
    function getServer($id_server)
    {
        try {
            $baseurl = \config('vunime.baseurl');
            $apikey = \config('vunime.apikey');
            $client = new Client();
            $res = $client->request("POST", $baseurl . "/vunime/anime/get-server", [
                "headers" => [
                    "x-api-key" => $apikey,
                ],
                "form_params" => [
                    'id' => $id_server,
                    'position' => '0',
                ]
            ]);
            $result = json_decode($res->getBody());
            return $result;
        } catch (\Throwable $th) {
            return array();
        }
    }
}

if (!function_exists('getUrlVideo')) {
    function getUrlVideo($url, $quality = 'SD')
    {
        try {
            $baseurl = \config('vunime.baseurl');
            $apikey = \config('vunime.apikey');
            $client = new Client();
            $res = $client->request("POST", $baseurl . "/vunime/anime/get-url-video", [
                "headers" => [
                    "x-api-key" => $apikey,
                ],
                "form_params" => [
                    'url' => $url,
                    'quality' => $quality
                ]
            ]);
            $result = json_decode($res->getBody());
            return $result;
        } catch (\Throwable $th) {
            return array();
        }
    }
}

if (!function_exists('findObjectById')) {
    function findObjectById($array, $id)
    {
        foreach ($array as $row) {
            if ($row->id == $id) return $row;
        }

        return false;
    }
}
