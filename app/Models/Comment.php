<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Baum\Node;

class Comment extends Node
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'post_id', 
        'content_cmt', 
        'parent_id',
        'like',
        'created_at', 
        'updated_at',
    ];

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
