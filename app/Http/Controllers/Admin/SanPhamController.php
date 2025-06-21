<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SanPhamController extends Controller
{
    function index(){
        $products = DB::table('products') ->get();
        return view('admin.quanlysanpham',['products'=> $products]);
    }
    public function create()
    {
        $categories = DB::table('categories')->get();
        return view('admin.addsanpham', compact('categories'));
    }
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB
            'description' => 'nullable|string'
        ]);

        // Xử lý upload ảnh
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = strtolower($file->getClientOriginalExtension());
            $newName = uniqid() . '.' . $ext;

            // Tạo thư mục nếu chưa có
            $uploadPath = public_path('uploads/products');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            // Di chuyển file vào thư mục uploads/products
            $file->move($uploadPath, $newName);

            // Đường dẫn lưu trong database (tương đối)
            $imagePath = 'uploads/products/' . $newName;
        }

        // Thêm sản phẩm vào database
        DB::table('products')->insert([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $imagePath, // lưu đường dẫn ảnh
            'quantity' => $request->quantity,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('products.create')->with('success', 'Thêm sản phẩm thành công!');
    }
}
