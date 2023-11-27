<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    use HasFactory;

    protected $table = 'comment_like';
    protected $primaryKey = 'like_id';

    protected $fillable = ['comment_id','user_id','is_like'];

    protected $casts = [
        'user_id' => 'integer',
        'is_like' => 'integer'
    ];
}
