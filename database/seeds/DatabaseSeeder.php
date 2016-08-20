<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // =========== generate data ===============//
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PostsTableSeeder::class);

        factory(App\Models\User::class, 50)->create()->each(function($u) {
            $u->posts()->save(factory(App\Models\Post::class)->make());
        });
        // =========== generate data ===============//

        // init relations
        $allPerms = \App\Models\Permission::all();

        $userShowPerm = \App\Models\Permission::where('name', 'user-show')->first();
        $userUpdatePerm = \App\Models\Permission::where('name', 'user-update')->first();
        $userDestroyPerm = \App\Models\Permission::where('name', 'user-destroy')->first();
        $postShowPerm = \App\Models\Permission::where('name', 'post-show')->first();

        $rootRole = \App\Models\Role::where('name', 'Root')->first();
        $adminRole = \App\Models\Role::where('name', 'Admin')->first();

        $rootUser = \App\Models\User::where('email', 'root@163.com')->first();
        $adminUser = \App\Models\User::where('email', 'admin@163.com')->first();

        // root -> all perms
        $rootRole->attachPermissions($allPerms);

        // admin -> all user  and only show of post
        $adminRole->attachPermission($userShowPerm);
        $adminRole->attachPermission($userUpdatePerm);
        $adminRole->attachPermission($userDestroyPerm);
        $adminRole->attachPermission($postShowPerm);

        // root_user -> root
        $rootUser->attachRole($rootRole);

        // admin_user -> admin
        $adminUser->attachRole($adminRole);

        // nothing for jack, he is a normal user.
    }
}
