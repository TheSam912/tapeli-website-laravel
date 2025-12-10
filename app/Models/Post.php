<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'cover_image',
        'title',
        'description',
        'author_id',
        'read_time',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
