<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bookmark extends Model
{
    use HasFactory;

    protected $table = 'bookmark';
    protected $primaryKey = 'bookmark_id';

    protected $fillable = ['user_id', 'anime_id'];

    public static function getBookmark($user)
    {
        return DB::table('bookmark')
            ->select('anime.title', 'anime.image', 'anime.year', 'anime.rating', 'bookmark.*')
            ->addSelect('history.history_id', 'history.anime_id as history_anime_id', 'history.episode_id as history_episode_id', 'history.server_id as history_server_id')
            ->join('anime', 'anime.anime_id', '=', 'bookmark.anime_id')
            ->leftJoin('history', 'history.anime_id', '=', 'bookmark.anime_id')
            ->where('bookmark.user_id', '=', $user->user_id)
            ->groupBy('anime_id')
            ->orderBy('bookmark.created_at', 'desc')
            ->get();
    }
    
    protected $casts = [
        'user_id' => 'integer',
        'anime_id' => 'integer'
    ];
}
