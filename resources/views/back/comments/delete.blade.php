<!-- Modal -->
<div class="modal fade" id="delModal{{$comment->id}}" tabindex="5" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="topic">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Comment:  <strong>{{$comment->content_cmt}}</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container" align="right">
                    <button class="btn btn-outline-secondary btn-sm float-sm-right" data-dismiss="modal" style="margin-left: 10px;">{{ trans('sub.cancel') }}</button>
                    {!! Form::model($comment, ['method' => 'POST', 'route' => ['comments.destroy', $comment->id] ]) !!}
                        {{ method_field('DELETE') }}
                        {!!  Form::submit('Delete', ['class'=>'btn btn-outline-danger btn-sm float-sm-right']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>