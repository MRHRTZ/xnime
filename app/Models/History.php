<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'history';
    protected $primaryKey = 'history_id';

    protected $fillable = ['user_id', 'anime_id', 'episode_id', 'server_id', 'play_time', 'max_time', 'episode', 'thumbnail'];
}
