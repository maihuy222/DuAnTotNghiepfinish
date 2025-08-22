<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tạo user mẫu đầu tiên
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'phone' => '0123456789',
                'address' => '123 Đường ABC, Quận 1, TP.HCM',
                'isDeleted' => 0,
                'avatar' => null
            ]
        );

        // Tạo thêm một số user mẫu
        User::firstOrCreate(
            ['email' => 'nguyenvana@gmail.com'],
            [
                'name' => 'Nguyễn Văn A',
                'password' => bcrypt('password'),
                'phone' => '0987654321',
                'address' => '456 Đường XYZ, Quận 2, TP.HCM',
                'isDeleted' => 0,
                'avatar' => null
            ]
        );

        User::firstOrCreate(
            ['email' => 'tranthib@gmail.com'],
            [
                'name' => 'Trần Thị B',
                'password' => bcrypt('password'),
                'phone' => '0369852147',
                'address' => '789 Đường DEF, Quận 3, TP.HCM',
                'isDeleted' => 0,
                'avatar' => null
            ]
        );

        User::firstOrCreate(
            ['email' => 'levanc@gmail.com'],
            [
                'name' => 'Lê Văn C',
                'password' => bcrypt('password'),
                'phone' => '0521478963',
                'address' => '321 Đường GHI, Quận 4, TP.HCM',
                'isDeleted' => 0,
                'avatar' => null
            ]
        );

        // Chạy các seeder con
        $this->call([
            PostCategorySeeder::class,
            EmployeeSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            SliderSeeder::class,
        ]);
    }
}
