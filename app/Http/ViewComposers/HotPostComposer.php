<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Post;

class HotPostComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('posts', Post::select('title', 'slug', 'like')->take(10)->orderBy('like', 'desc')->get());
    }
}
