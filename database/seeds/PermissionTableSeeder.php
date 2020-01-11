<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('role_has_permissions')->truncate();
        DB::table('user_has_permissions')->truncate();
        DB::table('user_has_roles')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //添加角色
        $role = \Spatie\Permission\Models\Role::create(['name' => 'administrator']);
        //添加权限
        \Spatie\Permission\Models\Permission::create(['name' => 'manage-user']);
        //给角色授权
        $role->givePermissionTo('manage-user');
        //将用户设置为管理员
        $user = \App\Models\User::find(1);
        $user->assignRole('administrator');
    }
}
