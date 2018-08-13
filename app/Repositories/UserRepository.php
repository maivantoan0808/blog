<?php

namespace App\Repositories;

use App\Models\User;
use App\Services\Thumb;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
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
     * @param  \App\Models\User $user
     */
    public function __construct(User $user, Thumb $thumb)
    {
        $this->model = $user;
        $this->thumb = $thumb;
    }

    /**
     * Update avatar for user.
     *
     * @param  App\Modles\User
     * @return \Illuminate\Http\Response
     */
    public function avatar($request, $user)
    {
        
        if($request->file('file') != null && checkExtensionImage($request->file('file')->getClientOriginalExtension())){
            $url = $this->thumb->makeThumbPath($request->file('file'), 'users');
            if ( $user->avatar != 'ava.png' && file_exists('upload/users/' . $user->avatar)) unlink('upload/users/' . $user->avatar);
        }else{
            $url = 'avatar.png';

        }
        $user->avatar = $url;
        $user->save();


        return response()->json($user->avatar);
    }

    /**
     * Get users collection paginate.
     *
     * @param  int  $nbrPages
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll($nbrPages)
    {
        $users =  User::select('id', 'name', 'email', 'point', 'avatar')->whereValid(true)->where('id', '!=',  Auth::id())->where('role', '!=', 1)->paginate($nbrPages);
        $users->count = User::whereValid(true)->where('role', '!=', 1)->count();

        return $users;
    }

}
