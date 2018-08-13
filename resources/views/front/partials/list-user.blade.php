@foreach($users as $user)
    <div class="col-md-4" style="padding: 10px;">
        <!-- Widget: user widget style 2 -->
        <div class=" card-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header badge-default">
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="/upload/users/{{$user->avatar}}" alt="User avatar" style="margin-right: 10px;">
                </div>
                <!-- /.widget-user-image -->
                <div>
                    <strong class="username"> <a href="{{ route('front.user.show', [$user->id]) }}">{{ $user->name }}</a></strong><br>
                    <small class="email">{{ $user->email }}</small><br>
                </div>
            </div>
            <div class=" p-0">
                <ul class="footer_labels">
                    <li><a class="btn btn-outline-primary btn-sm " href="" style="padding: 0 3px 0 3px">Posts | {{ $user->point }}</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.widget-user -->
    </div>
    <!-- /.col -->
@endforeach