<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('users', User::select('id', 'name', 'email', 'point', 'avatar')->whereValid(true)->where('id', '!=',  Auth::id())->where('role', '!=', 1)->get()->take(5) );
    }
}
