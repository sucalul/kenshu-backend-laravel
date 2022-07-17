<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            '総合', 'テクノロジー', 'モバイル', 'アプリ', 'エンタメ',
            'ビューティー', 'ファッション', 'ライフスタイル', 'ビジネス',
            'グルメ', 'スポーツ'
        ];

        foreach ($params as $param) {
            DB::table('tags')->insert([
                'name' => $param
            ]);
        }
    }
}
