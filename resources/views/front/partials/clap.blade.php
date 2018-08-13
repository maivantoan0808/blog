@guest
<a class="claps_button btn-tool clap" href="{{ route('login') }}">
    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
</a>
<span class="badge" id="number-like{{$post->id}}">{{ $post->like }}</span>
@else
    @if (Auth::User()->isLike($post->id))
        {{ csrf_field() }}
        <a class="claps_button btn-tool clap{{$post->id}}" onmousedown="mouseDown({{$post->id}})">
            <i class="fa fa-thumbs-up"></i>
            <i class="fa fa-thumbs-o-up hide"></i>
        </a>
        <span class="badge"  id="number-like{{$post->id}}">{{ $post->like }}</span>
    @else
        {{ csrf_field() }}
        <a class="claps_button btn-tool clap{{$post->id}}" onmousedown="mouseDown({{$post->id}})">
            <i class="fa fa-thumbs-o-up"></i>
            <i class="fa fa-thumbs-up hide"></i>
        </a>
        <span class="badge"  id="number-like{{$post->id}}">{{ $post->like }}</span>
    @endif
@endguest

@section('js')
<script>
    @guest
    @else
    @if (Auth::User()->isLike($post->id))
        function mouseDown(id) {
            $('.clap' + id + ' .fa-thumbs-up').addClass('hide');
            $('.clap' + id + ' .fa-thumbs-o-up').removeClass('hide');
            like(id);
        }
    @else
        function mouseDown(id) {
            $('.clap' + id + ' .fa-thumbs-up').removeClass('hide');
            $('.clap' + id + ' .fa-thumbs-o-up').addClass('hide');
            like(id);
        }
    @endif
    @endguest

    function like(post_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: 'posts/like/' + post_id,
            type: 'PUT',
            dataType: 'json',
            data: {
                '_token': $('input[name=_token]').val(),
                'post_id': post_id
            },
            success: function(data) {
                // console.log('ok');
                $('#number-like' + post_id).text(data);
                console.log(data);
            },
            error: function(error) {
                console.log('error');
                console.log(error);
            }
        });
    }
</script>
@endsection
