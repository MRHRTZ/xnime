<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class History extends Model
{
    use HasFactory;

    protected $table = 'history';
    protected $primaryKey = 'history_id';

    protected $fillable = ['user_id', 'anime_id', 'episode_id', 'server_id', 'play_time', 'max_time', 'episode'];

    public static function getHistory($user)
    {
        return DB::table('history')
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
            ->orderBy('updated_at','desc')
            ->get();
    }
}
