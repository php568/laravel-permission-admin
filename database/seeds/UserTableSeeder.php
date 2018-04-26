<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //清空表
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \Illuminate\Support\Facades\DB::table('model_has_permissions')->truncate();
        \Illuminate\Support\Facades\DB::table('model_has_roles')->truncate();
        \Illuminate\Support\Facades\DB::table('role_has_permissions')->truncate();
        \Illuminate\Support\Facades\DB::table('users')->truncate();
        \Illuminate\Support\Facades\DB::table('roles')->truncate();
        \Illuminate\Support\Facades\DB::table('permissions')->truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //用户
        $user = \App\User::create([
            'name'  => 'root',
            'email' => 'root@dgg.net',
            'phone' => '18988888888',
            'password'  => '123456'
        ]);

        //角色
        $role = \Spatie\Permission\Models\Role::create([
            'name'  => 'root',
            'display_name'  => '超级管理员'
        ]);

        //权限
        $permissions = [
            //一级权限
            ['id'=>1,'name'=>'system.manage','display_name'=>'系统管理','parent_id'=>0],
            //二级权限
            ['id'=>2,'name'=>'system.user','display_name'=>'用户管理','parent_id'=>1],
            ['id'=>3,'name'=>'system.role','display_name'=>'角色管理','parent_id'=>1],
            ['id'=>4,'name'=>'system.permission','display_name'=>'权限管理','parent_id'=>1],
            //三级权限：用户
            ['id'=>5,'name'=>'system.user.create','display_name'=>'添加用户','parent_id'=>2],
            ['id'=>6,'name'=>'system.user.edit','display_name'=>'编辑用户','parent_id'=>2],
            ['id'=>7,'name'=>'system.user.destroy','display_name'=>'删除用户','parent_id'=>2],
            ['id'=>8,'name'=>'system.user.role','display_name'=>'分配角色','parent_id'=>2],
            ['id'=>9,'name'=>'system.user.permission','display_name'=>'分配权限','parent_id'=>2],
            //三级权限：角色
            ['id'=>10,'name'=>'system.role.create','display_name'=>'添加角色','parent_id'=>3],
            ['id'=>11,'name'=>'system.role.edit','display_name'=>'编辑角色','parent_id'=>3],
            ['id'=>12,'name'=>'system.role.destroy','display_name'=>'删除角色','parent_id'=>3],
            ['id'=>13,'name'=>'system.role.permission','display_name'=>'分配权限','parent_id'=>3],
            //三级权限：权限
            ['id'=>14,'name'=>'system.permission.create','display_name'=>'添加权限','parent_id'=>4],
            ['id'=>15,'name'=>'system.permission.edit','display_name'=>'编辑权限','parent_id'=>4],
            ['id'=>16,'name'=>'system.permission.destroy','display_name'=>'删除权限','parent_id'=>4],
        ];
        foreach ($permissions as $permission){
            //生成权限
            $perm = \Spatie\Permission\Models\Permission::create($permission);
            //为角色添加权限
            $role->givePermissionTo($perm);
            //为用户添加权限
            $user->givePermissionTo($perm);
        }
        
        //为用户添加角色
        $user->assignRole($role);

    }
}
