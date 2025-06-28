<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            [
                'id' => 1,
                'name' => 'Nguyễn Văn An',
                'email' => 'nguyenvanan@restaurant.com',
                'isDeleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Trần Thị Bình',
                'email' => 'tranthibinh@restaurant.com',
                'isDeleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Lê Văn Cường',
                'email' => 'levancuong@restaurant.com',
                'isDeleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'name' => 'Phạm Thị Dung',
                'email' => 'phamthidung@restaurant.com',
                'isDeleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($employees as $employee) {
            DB::table('employees')->insert($employee);
        }
    }
} 