<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comment';
    protected $primaryKey = 'comment_id';

    protected $fillable = ['user_id','anime_id','episode_id','parent_id','content'];

    protected $casts = [
        'user_id' => 'integer',
        'anime_id' => 'integer',
        'episode_id' => 'integer',
        'parent_id' => 'integer',
    ];
}
