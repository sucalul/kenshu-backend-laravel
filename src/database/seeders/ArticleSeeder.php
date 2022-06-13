<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
            'user_id' => 1,
            'thumbnail_image_id' => 1,
            'title' => 'title111',
            'body' => 'body111',
        ]);
        DB::table('articles')->insert([
            'user_id' => 1,
            'thumbnail_image_id' => 2,
            'title' => 'title222',
            'body' => 'body222',
        ]);
    }
}
