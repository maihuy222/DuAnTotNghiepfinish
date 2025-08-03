<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class SanPhamController extends Controller
{
    function index()
    {
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->where('products.isDeleted', 0) // Chỉ lấy sản phẩm chưa bị xóa
            ->get();

        return view('admin.quanlysanpham', ['products' => $products]);
    }
     function create()
    {
        $categories = DB::table('categories')->get();
        return view('admin.addsanpham', compact('categories'));
    }
  function store(Request $request)
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
         function edit($id)
    {
        $product = DB::table('products')->find($id);
        $categories = DB::table('categories')->get();

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Sản phẩm không tồn tại.');
        }

        return view('admin.editSanPham', compact('product', 'categories'));
    }

    // 👉 2️⃣ Cập nhật sản phẩm
    function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string'
        ]);

        $product = DB::table('products')->find($id);
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Sản phẩm không tồn tại.');
        }

        $imagePath = $product->image;

        // Nếu có file ảnh mới → upload và xóa ảnh cũ
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($imagePath && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }
            $file = $request->file('image');
            $newName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $newName);
            $imagePath = 'uploads/products/' . $newName;
        }

        DB::table('products')->where('id', $id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    // 👉 3️⃣ Xóa sản phẩm (soft delete)
    function destroy($id)
    {
        $product = DB::table('products')->find($id);
        if (!$product) {
            return redirect()->route('admin.products.index')->with('error', 'Sản phẩm không tồn tại.');
        }

        // Xóa mềm - chỉ đánh dấu isDeleted = 1
        DB::table('products')->where('id', $id)->update([
            'isDeleted' => 1,
            'updated_at' => now()
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công!');
    }

    // 👉 4️⃣ Khôi phục sản phẩm đã xóa
    function restore($id)
    {
        $product = DB::table('products')->find($id);
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Sản phẩm không tồn tại.');
        }

        // Khôi phục - đánh dấu isDeleted = 0
        DB::table('products')->where('id', $id)->update([
            'isDeleted' => 0,
            'updated_at' => now()
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Khôi phục sản phẩm thành công!');
    }

    // 👉 5️⃣ Xóa vĩnh viễn sản phẩm (chỉ dùng khi thực sự cần)
    function forceDelete($id)
    {
        $product = DB::table('products')->find($id);
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Sản phẩm không tồn tại.');
        }

        // Xóa file ảnh nếu có
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        // Xóa vĩnh viễn khỏi database
        DB::table('products')->where('id', $id)->delete();

        return redirect()->route('products.index')->with('success', 'Xóa vĩnh viễn sản phẩm thành công!');
    }
}


