<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    protected $table = 'anime';
    protected $primaryKey = 'anime_id';

    protected $fillable = ['anime_id','user_id','title','image','year','rating', 'total_episode'];

    protected $casts = [
        'anime_id' => 'integer',
        'user_id' => 'integer'
    ];
}
