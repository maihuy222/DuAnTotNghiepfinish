<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;
use App\Models\Product;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy user đầu tiên
        $user = User::first();
        if (!$user) {
            $this->command->info('No users found. Please create a user first.');
            return;
        }

        // Lấy product đầu tiên
        $product = Product::first();
        if (!$product) {
            $this->command->info('No products found. Please create a product first.');
            return;
        }

        // Tạo một số comment test
        $comments = [
            [
                'post_id' => $product->id,
                'user_id' => $user->id,
                'content' => 'Món ăn rất ngon, gà mềm và sốt dặm da!',
                'status' => 'approved',
                'isDeleted' => 0
            ],
            [
                'post_id' => $product->id,
                'user_id' => $user->id,
                'content' => 'Mình đặt size lớn ăn no nê, sẽ quay lại làn sau.',
                'status' => 'approved',
                'isDeleted' => 0
            ],
            [
                'post_id' => $product->id,
                'user_id' => $user->id,
                'content' => 'Chất lượng tốt, giao hàng nhanh!',
                'status' => 'approved',
                'isDeleted' => 0
            ]
        ];

        foreach ($comments as $commentData) {
            Comment::create($commentData);
        }

        $this->command->info('CommentSeeder completed successfully!');
    }
} 