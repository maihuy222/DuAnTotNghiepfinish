<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('postcategories')->delete();

        $categories = [
            [
                'id' => 1,
                'name' => 'Món chính',
                'isDeleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Món ăn nhanh',
                'isDeleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Tráng miệng',
                'isDeleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'name' => 'Đồ uống',
                'isDeleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('postcategories')->insert($categories);
    }
}
