<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $admin_role = Role::where('name','admin')->first();
        $permission_ids = []; // an empty array of stored permission IDs
    // iterate though all routes
        foreach (Route::getRoutes()->getRoutes() as $key => $route){
            // get route action
            $action = $route->getActionname();
            // separating controller and method
            $_action = explode('@',$action);
            $controller = $_action[0];
            $method = end($_action);
            // check if this permission is already exists
            $permission_check = Permission::where(
                    ['controller'=>$controller,'method'=>$method]
                )->first();
            if(!$permission_check){
                $permission = new Permission;
                $permission->controller = $controller;
                $permission->method = $method;
                $permission->save();
                // add stored permission id in array
                if(!$admin_role->permissions()->where('permission_id',$permission->id)->first()) $permission_ids[] = $permission->id;
               
            }else{
                if(!$admin_role->permissions()->where('permission_id',$permission_check->id)->first()) $permission_ids[] = $permission_check->id;
            }
            
        }
        // atache all permissions to admin role
        $admin_role->permissions()->attach($permission_ids);
    }
}
