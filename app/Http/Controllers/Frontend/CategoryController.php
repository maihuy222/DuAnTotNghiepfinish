<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function show($slug)
    {
        // Tìm category theo slug và chưa bị xóa
        $category = Category::where('slug', $slug)
            ->where('isDeleted', 0)
            ->first();

        if (!$category) {
            abort(404);
        }

        // Ngược lại → hiển thị sản phẩm theo danh mục
        $products = DB::table('products')
            ->where('category_id', $category->id)
            ->where('isDeleted', 0)
            ->get();

        return view('frontend.category.show', compact('category', 'products'));
    }
}
