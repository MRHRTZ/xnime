<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function store_anime($anime_id, $animeDetail=null)
    {
        $detail = $animeDetail ?? getAnimeDetail($anime_id);
        $anime = Anime::find($anime_id);
        if (!$anime) {
            Anime::create([
                'anime_id' => $detail->id,
                'title' => $detail->title,
                'image' => $detail->image_cover,
                'year' => $detail->tahun,
                'rating' => $detail->rating,
                'total_episode' => $detail->total_episode,
            ]);
        } else if ($anime && $anime->total_episode == null) {
            $anime->title = $detail->title;
            $anime->image = $detail->image_cover;
            $anime->year = $detail->tahun;
            $anime->rating = $detail->rating;
            $anime->total_episode = $detail->total_episode;
            $anime->save();
        }
    }
}
