<?php

namespace App\Http\Middleware;

use App\Model\User;
use Closure;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // get current request method
        $route = \Route::current()->getActionName();   //"App\Http\Controllers\Admin\LoginController@index"
        // get current user's permission
        $user = User::find(session()->get('user')->user_id);
        // get current user's role
        $roles = $user->role;
        $permissions = [];
        foreach ($roles as $v){
            $perms = $v->permission;
            foreach ($perms as $perm){
                $permissions[] = $perm->per_url;
            }
        }
        // remove the same permissions
        $permissions = array_unique($permissions);
        if(in_array($route,$permissions)){
            return $next($request);
        }else{
            return redirect('admin/noaccess');
        }

    }
}
