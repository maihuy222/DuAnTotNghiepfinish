<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Phở Bò Nam Định',
                'content' => 'Phở bò truyền thống Nam Định với nước dùng đậm đà, bánh phở dai ngon, thịt bò tươi ngon. Món ăn truyền thống được chế biến theo công thức gia truyền, đảm bảo hương vị đặc trưng của Nam Định.',
                'image' => 'pho-bo.jpg',
                'category_id' => 1,
                'employee_id' => 1,
                'isDeleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Bún Chả Hà Nội',
                'content' => 'Bún chả Hà Nội với thịt nướng thơm ngon, nước mắm pha chế đặc biệt, bún tươi. Món ăn đặc trưng của ẩm thực Hà Nội, được chế biến từ thịt heo tươi ngon.',
                'image' => 'bun-cha.jpg',
                'category_id' => 1,
                'employee_id' => 1,
                'isDeleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Cơm Tấm Sài Gòn',
                'content' => 'Cơm tấm với sườn nướng, chả trứng, bì heo và nước mắm pha chế đặc biệt. Món ăn đặc trưng của ẩm thực Sài Gòn, cơm tấm dẻo thơm.',
                'image' => 'com-tam.jpg',
                'category_id' => 1,
                'employee_id' => 2,
                'isDeleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Bánh Mì Thịt Nướng',
                'content' => 'Bánh mì Việt Nam với thịt nướng, rau sống, dưa leo và nước sốt đặc biệt. Bánh mì giòn, thịt nướng thơm ngon, rau sống tươi.',
                'image' => 'banh-mi.jpg',
                'category_id' => 2,
                'employee_id' => 2,
                'isDeleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Gỏi Cuốn Tôm Thịt',
                'content' => 'Gỏi cuốn tươi với tôm, thịt luộc, rau sống và nước mắm pha chế. Món ăn thanh mát, phù hợp cho những ngày nóng.',
                'image' => 'goi-cuon.jpg',
                'category_id' => 2,
                'employee_id' => 3,
                'isDeleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Chè Ba Màu',
                'content' => 'Chè ba màu truyền thống với đậu xanh, bột lọc và nước cốt dừa. Món tráng miệng ngọt ngào, màu sắc đẹp mắt.',
                'image' => 'che-ba-mau.jpg',
                'category_id' => 3,
                'employee_id' => 3,
                'isDeleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Cà Phê Sữa Đá',
                'content' => 'Cà phê sữa đá Việt Nam với hương vị đậm đà, sữa đặc ngọt. Thức uống truyền thống của người Việt Nam.',
                'image' => 'ca-phe-sua-da.jpg',
                'category_id' => 4,
                'employee_id' => 4,
                'isDeleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Trà Sữa Trân Châu',
                'content' => 'Trà sữa trân châu với hương vị thơm ngon, trân châu dai giòn. Thức uống được giới trẻ yêu thích.',
                'image' => 'tra-sua-tran-chau.jpg',
                'category_id' => 4,
                'employee_id' => 4,
                'isDeleted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
} 