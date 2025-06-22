<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy danh sách user và post để tạo comment
        $users = User::all();
        $posts = Post::all();

        if ($users->isEmpty() || $posts->isEmpty()) {
            $this->command->info('Cần có dữ liệu users và posts trước khi tạo comments!');
            return;
        }

        $comments = [
            [
                'post_id' => 1, // Phở Bò Nam Định
                'user_id' => 8,
                'content' => 'Phở rất ngon, nước dùng đậm đà, thịt bò tươi ngon. Sẽ quay lại ăn tiếp!',
                'status' => 'approved',
                'isDeleted' => 0
            ],
            [
                'post_id' => 1,
                'user_id' => 9,
                'content' => 'Phở ngon nhưng hơi mặn, có thể giảm bớt muối được không?',
                'status' => 'pending',
                'isDeleted' => 0
            ],
            [
                'post_id' => 2, // Bún Chả Hà Nội
                'user_id' => 10,
                'content' => 'Bún chả đúng chuẩn Hà Nội, thịt nướng thơm ngon, nước mắm pha chế rất ngon!',
                'status' => 'approved',
                'isDeleted' => 0
            ],
            [
                'post_id' => 2,
                'user_id' => 11,
                'content' => 'Thịt nướng hơi khô, có thể ướp ẩm hơn được không?',
                'status' => 'rejected',
                'isDeleted' => 0
            ],
            [
                'post_id' => 3, // Cơm Tấm Sài Gòn
                'user_id' => 8,
                'content' => 'Cơm tấm ngon lắm, sườn nướng thơm phức, chả trứng béo ngậy!',
                'status' => 'approved',
                'isDeleted' => 0
            ],
            [
                'post_id' => 4, // Bánh Mì Thịt Nướng
                'user_id' => 8,
                'content' => 'Bánh mì giòn, thịt nướng ngon, rau sống tươi. Rất hài lòng!',
                'status' => 'approved',
                'isDeleted' => 0
            ],
            [
                'post_id' => 4,
                'user_id' => 11,
                'content' => 'Bánh mì ngon nhưng hơi nhỏ, có thể làm to hơn được không?',
                'status' => 'pending',
                'isDeleted' => 0
            ],
            [
                'post_id' => 5, // Gỏi Cuốn Tôm Thịt
                'user_id' => 9,
                'content' => 'Gỏi cuốn tươi ngon, tôm và thịt luộc vừa chín tới, nước mắm pha chế rất ngon!',
                'status' => 'approved',
                'isDeleted' => 0
            ],
            [
                'post_id' => 6, // Chè Ba Màu
                'user_id' => 3,
                'content' => 'Chè ba màu ngon, đậu xanh bùi, nước cốt dừa béo ngậy. Tráng miệng rất hợp!',
                'status' => 'approved',
                'isDeleted' => 0
            ],
            [
                'post_id' => 7, // Cà Phê Sữa Đá
                'user_id' => 11,
                'content' => 'Cà phê sữa đá đúng chuẩn Việt Nam, đậm đà và ngọt vừa phải!',
                'status' => 'approved',
                'isDeleted' => 0
            ],
            [
                'post_id' => 8, // Trà Sữa Trân Châu
                'user_id' => 9,
                'content' => 'Trà sữa ngon, trân châu dai giòn, độ ngọt vừa phải. Rất thích!',
                'status' => 'approved',
                'isDeleted' => 0
            ],
            [
                'post_id' => 8,
                'user_id' => 10,
                'content' => 'Trà sữa ngon nhưng hơi ngọt, có thể giảm đường được không?',
                'status' => 'pending',
                'isDeleted' => 0
            ]
        ];

        foreach ($comments as $comment) {
            // Kiểm tra xem user_id và post_id có tồn tại không
            if (User::find($comment['user_id']) && Post::find($comment['post_id'])) {
                Comment::create($comment);
            }
        }
    }
} 