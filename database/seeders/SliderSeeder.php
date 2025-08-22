<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = [
            [
                'title' => 'Khuyến mãi mùa hè',
                'image' => 'sliders/summer_sale.jpg',
                'link' => 'https://example.com/summer-sale',
                'isDeleted' => false,
            ],
            [
                'title' => 'Sản phẩm mới',
                'image' => 'sliders/new_products.jpg',
                'link' => 'https://example.com/new-products',
                'isDeleted' => false,
            ],
            [
                'title' => 'Giảm giá 50%',
                'image' => 'sliders/discount_50.jpg',
                'link' => 'https://example.com/discount-50',
                'isDeleted' => false,
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::create($slider);
        }
    }
} 