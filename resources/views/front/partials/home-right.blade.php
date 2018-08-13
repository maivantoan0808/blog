<div style="padding: 5px;"></div>
<div class="card-primary">
    <span class="hot badge-info navbar-badge" style="z-index: 100;">Hot Authors</span>
    <ul class="list-group">
        @foreach($users as $user)
            <li class="list-group-item">
                <div class="media w-100">
                    <img class="media-object img-circle elevation-1 img-fluid mr-3" src="/upload/users/{{$user->avatar}}" width="30">
                    <div class="media-body align-self-center">
                        <strong class="username"> <a href="{{ route('front.user.show', [$user->id]) }}">{{ $user->name }}</a></strong><br>
                        <small class="email">{{ $user->email }}</small>
                    </div>
                </div>
            </li>
        @endforeach
        <li class="list-group-item text-center" style=" font-size: 15px; padding: 5px;">
            <a href="{{ route('front.user.index') }}">View All <span class="fa fa-angle-double-right"  style=" font-size: 12px;"></span></a>
        </li>
    </ul>
</div>
<div style="padding: 10px;"></div>
