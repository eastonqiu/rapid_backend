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
            'name' => 'test',
            'email' => 'test@163.com',
            'nickname' => 'test',
            'avatar' => 'http://img.mp.itc.cn/upload/20160528/74a3f298a3184542bd468786d59feae9.jpg',
            'sex' => 1,
            'city' => '深圳',
            'country' => '中国',
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
