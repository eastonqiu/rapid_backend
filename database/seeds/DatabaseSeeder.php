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
        factory(App\Models\User::class, 50)->create()->each(function($u) {
            $u->posts()->save(factory(App\Models\Post::class)->make());
        });
        $this->call(UsersTableSeeder::class);
        $this->call(PostsTableSeeder::class);
    }
}
