<?php

namespace App\Repositories;

use App\Models\ {
	Post,
    Comment,
    Topic,
    User
};
use App\Services\Thumb;

class PostRepository
{
    /**
     * The Comment instance.
     *
     * @var \App\Models\Comment
     */
    protected $comment;

    /**
     * The Model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The Upload instance.
     *
     * @var App\Services\Thumb
     */
    protected $thumb;

    /**
     * Create a new BlogRepository instance.
     *
     * @param  \App\Models\Post $post
     * @param  \App\Models\Comment $comment
     */
    public function __construct(Post $post, Comment $comment, Thumb $thumb)
    {
        $this->model = $post;
        $this->comment = $comment;
        $this->thumb = $thumb;
    }

    /**
     * Create a query for Post.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function queryActivePost()
    {
        return $this->model
            ->select('id', 'user_id', 'title', 'slug', 'description', 'content', 'url_img', 'updated_at', 'created_at', 'like')
            ->whereStatus(true)
            ->with(['parentComments' => function ($q) {
            $q->with('user')
                ->latest()
                ->take(config('app.numberParentComments'));
            }])
            ->withCount('validComments')
            ->withCount('parentComments');
    }

    /**
     * Create a query for Post with user, tags, topic.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function queryActivePostWithRelated()
    {
        return $this->queryActivePost()->with([
            'user' => function ($q) {
                $q->select('id', 'name', 'email', 'avatar');
            },
            'topic' => function ($q) {
                $q->select('id', 'name_topic', 'slug_topic');
            },
        ]);
    }

    /**
     * Get active posts.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getActiveOrderByDate()
    {
        return $this->queryActivePost()->latest()->paginate(10);
    }

    /**
     * Get active posts for specified topic.
     *
     * @param  int  $nbrPages
     * @param  string  $category_slug
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getActiveOrderByDateForTopic($nbrPages, $topic_slug)
    {
        return $this->queryActivePost()
        ->whereHas('topic', function ($q) use ($topic_slug) {
            $q->where('topics.slug_topic', $topic_slug);
        })->latest()->paginate($nbrPages);
    }

    /**
     * Get posts with comments page home.
      *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getAll($nbrPages)
    {
        // Post with user, tags and topics
        $posts = $this->queryActivePostWithRelated()->latest()->paginate($nbrPages);

        return $posts;
    }

    /**
    * Get post by slug.
    *
    * @param  string  $slug
    * @return array
    */
    public function getPostBySlug($slug)
    {
        // Post for slug with user, tags and topics
        $post = $this->queryActivePostWithRelated()
        ->whereSlug($slug)
        ->latest()
        ->firstOrFail();

        // Previous post
        $post->previous = $this->getPreviousPost($post->id);

        // Next post
        $post->next = $this->getNextPost($post->id);

        $post->related = $this->getRelated($post->topic_id, $post->id);

        return compact('post');
    }

    /**
     * Get related post
     *
     * @param  integer  $topic_id, $id
     * @return \Illuminate\Database\Eloquent\Collection
     */

    protected function getRelated($topic_id, $id)
    {
        return $this->model->select('title', 'slug', 'like')->where('id', '!=', $id)->where('topic_id', $topic_id)->orderBy('like', 'desc')->get();
    }

    /**
     * Get previous post
     *
     * @param  integer  $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getPreviousPost($id)
    {
        return $this->model->select('title', 'slug')->where('id', '<', $id)->latest('id')->first();
    }

    /**
     * Get next post
     *
     * @param  integer  $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getNextPost($id)
    {
        return $this->model->select('title', 'slug')->where('id', '>', $id)->oldest('id')->first();
    }

    /**
     * Get post by user.
     *
     * @param  string  $slug
     * @return array
     */
    public function getPostByUser($user_id, $nbrPages)
    {
        // Post for slug with user, tags and categories
        $posts = $this->queryActivePostWithRelated()
        ->where('user_id', $user_id)
        ->latest()
        ->paginate($nbrPages);
        
        return compact('posts');
    }

    /**
     * Store post.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return void
     */
    public function store($request)
    {
        if($request->file('img') != null){
            $url = $this->thumb->makeThumbPath($request->file('img'), 'posts');
        }else $url = null;
    	
        $request->merge([
            'user_id' => auth()->id(),
            'status' => $request->has('status'),
            'url_img' => $url,
        ]);
        $post = Post::create($request->all());
        $user = User::find(auth()->id());
        $user->point += 1;
        $user->save();
    }

    /**
     * Update post.
     *
     * @param  \App\Models\Post  $post
     * @param  \App\Http\Requests\PostRequest  $request
     * @return void
     */
    public function update($post, $request)
    {
        if($request->file('img') != null){
            $url = $this->thumb->makeThumbPath($request->file('img'), 'posts');
            if ( $post->url_img != null && file_exists('upload/posts/' . $post->url_img)) unlink('upload/posts/' . $post->url_img);
            $request->merge(['url_img' => $url]);
        }
        
        $request->merge(['status' => $request->has('status')]);
        $post->update($request->all());
    }

    /**
     * Get posts with search.
     *
     * @param  int  $n
     * @param  string  $search
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search($n, $search)
    {
        $posts = $this->queryActiveOrderByDate()
        ->where(function ($q) use ($search) {
            $q->where('title', 'like', "%$search%")
                ->orwhere('slug', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhere('content', 'like', "%$search%");
        })->paginate($n);

        return $posts;
    }

}
