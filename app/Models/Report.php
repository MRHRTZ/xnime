<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'report';
    protected $primaryKey = 'report_id';

    protected $fillable = ['user_id','anime_id','episode_id','server_id'];

    protected $casts = [
        'user_id' => 'integer',
        'anime_id' => 'integer',
        'episode_id' => 'integer',
        'server_id' => 'integer',
    ];
}
