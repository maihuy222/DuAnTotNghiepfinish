<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ input name="q"
        $keyword = $request->input('q');

        // Nếu không có từ khóa thì quay về trang trước
        if (!$keyword) {
            return redirect()->back()->with('error', 'Vui lòng nhập từ khóa tìm kiếm.');
        }

        // Tìm kiếm trong bảng products theo tên hoặc mô tả
        $products = Product::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->with('category', 'sizes') // eager load nếu bạn cần
            ->get();

        // Trả về view và truyền dữ liệu
        return view('frontend.search', compact('products', 'keyword'));
    }
    public function autocomplete(Request $request)
    {
        $keyword = $request->get('query');

        $results = Product::where('name', 'like', '%' . $keyword . '%')
            ->limit(10)
            ->pluck('name');

        return response()->json($results);
    }
}
