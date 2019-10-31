<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Permission;
use App\Role;

use Closure;

class RolesAuth
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
        // get user role permissions
        $user = Auth::user();
        if( $user===null) return redirect(route('superLogin'));
        if($user->role_id > 3) return redirect(route('home'));
        $role = Role::findOrFail($user->role_id);
        $permissions = $role->permissions;
        // get requested action
        $actionName = class_basename($request->route()->getActionname());
        // check if requested action is in permissions list
        foreach ($permissions as $permission)
        {
        $_namespaces_chunks = explode('\\', $permission->controller);
        $controller = end($_namespaces_chunks);
        if ($actionName == $controller . '@' . $permission->method) return $next($request);
        }
        // none authorized request
        return response('Permission Denied', 403);
    }
}
