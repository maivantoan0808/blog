 @foreach($posts as $post)
    <!-- post -->
    <div class="col-md-12">
        <!-- Box Comment -->
        <div class="card card-widget">
            <div class="card-header">
                <div class="user-block">
                    <img class="img-circle" src="/upload/users/{{$post->user->avatar}}" alt="User Image">
                    <span class="username"><a href="{{ route('front.user.show', [$post->user->id]) }}">{{$post->user->name}}</a>
                    </span>
                    <span class="description">{{ $post->updated_at->formatLocalized('%A %d %B %Y, %I:%M:%S %p') }}</span>                                        
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                    @include('front.partials.clap')
                    @if(Auth::check() && Auth::user()->name == $post->user->name)
                        <a href="{{ route('home.posts.edit', [$post->id]) }}" title="Update">
                            <button type="button" class="btn btn-tool"><i class="fa fa-pencil-square-o"></i></button>
                        </a>
                    	<button type="button" title="Delete" class="btn btn-tool" data-toggle="modal" data-target="#delModal{{$post->id}}"> <i class="fa fa-trash-o"></i></button>
                        @include('front.partials.delete-post')
                        @else
                        <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		            @endif
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- /.user-block -->
                  <div class="row mb-3">
                    <div class="col-sm-12">
                        <h5><a href="{{ url('posts/' . $post->slug) }}">{{$post->title}}</a></h5>
                        <p>{!! $post->description !!}
                            @if($post->type === 1)
                                @if(strlen($post->content_post) < 2000)
                                    <a href="javascript:void(0)"  id="read-more{{$post->id}}" onclick="readMore({{$post->id}})">... more</a>
                                @else
                                    <a href="{{ url('posts/' . $post->slug) }}">... more</a>
                                @endif
                            @endif
                        </p>
                        @if($post->url_img != null)
                            <a target="_blank" href="/upload/posts/{{$post->url_img}}" class="row justify-content-center align-items-center">
                                <img src="/upload/posts/{{$post->url_img}}" alt="Forest" class="img-fluid mb-3" style="width:300px">
                            </a>
                         @endif
                        <div style="display: none;" id="content{{$post->id}}">
                            <div>
                                <div>@php echo($post->content_post) @endphp</div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    </div>
                  <!-- /.row -->
                <!-- Social sharing buttons -->
                <a href="#" class="link-black text-sm"><i class="fa fa-star mr-1"></i> Like ({{ $post->like }})</a>
                
                <span class="float-right">
                    <a href="#" class="link-black text-sm">
                        <i class="fa fa-comments-o mr-1"></i> {{ trans_choice(__('comment|comments'), $post->valid_comments_count) }} ({{ $post->valid_comments_count }})
                    </a>
                </span>
            </div>
            <!-- /.card-body -->
            <div class="card-footer form-comment{{$post->id}}">
                @if (Auth::check())
                   <!--  <form action="{{ route('posts.comments.store', [$post->id]) }}" method="post">
                        {{ csrf_field() }} -->
                        <img class="img-fluid img-circle img-sm" src="/upload/users/{{Auth::user()->avatar}}" alt="Alt Text">
                        <!-- .img-push is used to add margin to elements next to floating images -->
                        <div class="img-push">
                            <input type="text" class="form-control form-control-sm" onclick="submitComment({{ $post->id}})"  placeholder="@lang('Press enter to post comment')" name="message" id="comment{{ $post->id}}" class="full-width" value="{{ old('message') }}" required>
                        </div>
                        <!-- @if ($errors->has('message'))
                            @component('front.components.error')
                                {{ $errors->first('message') }}
                            @endcomponent
                        @endif
                    </form> -->
                 @else
                    <em>@lang('You must be logged to add a comment !')</em>
                @endif
            </div>
            <!-- /.card-footer -->
            
            <!-- commentlist -->
            @if ($post->valid_comments_count)
                @php
                    $level = 0;
                    $comments = $post->parentComments->take(2);
                @endphp
                
                    <div class="card-footer card-comments">
                        <div class="commentlist{{ $post->id }}">
                            @include('front/comments/comments', ['comments' => $post->parentComments->take(2)])
                        </div>

                        @if ($post->parent_comments_count > config('app.numberParentComments'))
                            <p id="morebutton{{$post->id}}" class="text-center" style="margin-top: 15px;">
                                <a id="comment-more{!! $post->id !!}" class="nextcomments" href="{{ route('posts.comments', [$post->id, 1]) }}" class="button">@lang('More comments ...')</a>
                            </p>
                            <p id="moreicon{{$post->id}}" class="text-center hide">
                                <span class="fa fa-spinner fa-pulse fa-3x fa-fw"></span>
                            </p>
                        @endif
                    </div>
                
            @endif
        </div>
        <!-- /.card -->
    </div>
    <!-- /.post -->
@endforeach