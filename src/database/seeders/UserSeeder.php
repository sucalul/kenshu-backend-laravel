<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'hoge',
            'email' => 'hoge@example.com',
            'password' => 'hoge',
            'profile_resource_id' => 1
        ]);
        DB::table('users')->insert([
            'name' => 'fuga',
            'email' => 'fuga@example.com',
            'password' => 'fuga',
            'profile_resource_id' => 2
        ]);
    }
}
