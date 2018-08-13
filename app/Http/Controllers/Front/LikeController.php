<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use App\Models\User;
use App\Models\Post;

class LikeController extends Controller
{
    public function like(Post $post)
    {
        if (!Auth::user()->isLike($post->id)) {
            // Create a new follow instance for the authenticated user
            Auth::user()->likes()->create([
                'post_id' => $post->id,
            ]);
            $post->like += 1;
            $post->save();
        } else {
         $like = Auth::user()->likes()->where('post_id', $post->id)->first();
            $like->delete();
            $post->like -= 1;
         $post->save();
        }
        return response ()->json($post->like);
    }
}
