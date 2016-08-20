<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'root',
            'email' => 'root@163.com',
            'nickname' => 'root',
            'avatar' => 'http://img.mp.itc.cn/upload/20160528/74a3f298a3184542bd468786d59feae9.jpg',
            'sex' => 1,
            'city' => 'Shenzhen',
            'country' => 'China',
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@163.com',
            'nickname' => 'admin',
            'avatar' => 'http://img.mp.itc.cn/upload/20160528/74a3f298a3184542bd468786d59feae9.jpg',
            'sex' => 1,
            'city' => 'Shenzhen',
            'country' => 'China',
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'jack',
            'email' => 'jack@163.com',
            'nickname' => 'jack',
            'avatar' => 'http://img.mp.itc.cn/upload/20160528/74a3f298a3184542bd468786d59feae9.jpg',
            'sex' => 1,
            'city' => 'Shenzhen',
            'country' => 'China',
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
