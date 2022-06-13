<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('article_images')->insert([
            'article_id' => 1,
            'resource_id' => 1,
        ]);
        DB::table('article_images')->insert([
            'article_id' => 2,
            'resource_id' => 2,
        ]);
    }
}
