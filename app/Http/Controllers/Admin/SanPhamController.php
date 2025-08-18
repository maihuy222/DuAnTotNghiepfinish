<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Support\Str;

class SanPhamController extends Controller
{
    function index()
    {
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->where('products.isDeleted', 0) // Chỉ lấy sản phẩm chưa bị xóa
            ->get();
        foreach ($products as $product) {
            $product->sizes = DB::table('productsizes') // tên bảng đúng
                ->join('sizes', 'productsizes.size_id', '=', 'sizes.id')
                ->where('productsizes.product_id', $product->id)
                ->where('productsizes.isDeleted', 0)
                ->select('sizes.name', 'productsizes.price')
                ->get();
        }

        return view('admin.products.quanlysanpham', ['products' => $products]);
       
    }
     function create()
    {
        $categories = DB::table('categories')->get();
        $sizes = DB::table('sizes')->where('isDeleted', 0)->get();

        return view('admin.products.addsanpham', compact('categories', 'sizes'));
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
        ], [
            'name.required' => 'Vui lòng nhập tên sản phẩm.',
            'name.unique'   => 'Tên sản phẩm đã tồn tại.',
            'quantity.required' => 'Vui lòng nhập số lượng.',
            'quantity.integer' => 'Số lượng phải là số nguyên.',
            'price.required' => 'Vui lòng nhập giá sản phẩm.',
            'price.numeric' => 'Giá phải là số.',
            'status.required' => 'Vui lòng chọn tình trạng.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'category_id.exists' => 'Danh mục đã chọn không hợp lệ.',
            'image.image'   => 'Tệp tải lên phải là hình ảnh.',
            'image.mimes'   => 'Ảnh phải có định dạng jpg, jpeg, png, gif hoặc svg.',
            'image.max'     => 'Kích thước ảnh tối đa là 2MB.',
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
        $slug = Str::slug($request->name);
        // Thêm sản phẩm vào database
        DB::table('products')->insert([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $imagePath, // lưu đường dẫn ảnh
            'quantity' => $request->quantity,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

         $productId = DB::getPdo()->lastInsertId();
        if ($request->has('prices')) {
            foreach ($request->prices as $sizeId => $price) {
                if ($price !== null && $price >= 0) {
                    DB::table('productsizes')->insert([
                        'product_id' => $productId,
                        'size_id' => $sizeId,
                        'price' => $price,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }


        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công!');
    }
         function edit($id)
    {
        $product = DB::table('products')->find($id);
        $categories = DB::table('categories')->get();
        $sizes = DB::table('sizes')->where('isDeleted', 0)->get();
        $sizesData = DB::table('productsizes')
            ->where('product_id', $id)
            ->get();

        // Chuyển thành mảng size_id => price
        $productSizes = [];
        foreach ($sizesData as $item) {
            $productSizes[$item->size_id] = $item->price;
        }

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Sản phẩm không tồn tại.');
        }

        return view('admin.products.editSanPham', compact('product', 'categories', 'sizes', 'productSizes'));
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
        // Xóa size cũ trước khi thêm size mới
        DB::table('product_sizes')->where('product_id', $id)->delete();

        // Thêm size mới (giá phải hợp lệ)
        if ($request->has('sizes') && $request->has('prices')) {
            foreach ($request->sizes as $sizeId => $value) {
                if (isset($request->prices[$sizeId]) && $request->prices[$sizeId] !== null) {
                    DB::table('product_sizes')->insert([
                        'product_id' => $id,
                        'size_id' => $sizeId,
                        'price' => $request->prices[$sizeId],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
        if ($request->has('sizes') && $request->has('prices')) {
            foreach ($request->sizes as $sizeId => $value) {
                if (isset($request->prices[$sizeId]) && $request->prices[$sizeId] !== null) {
                    DB::table('product_sizes')->insert([
                        'product_id' => $id,
                        'size_id' => $sizeId,
                        'price' => $request->prices[$sizeId],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        $slug = Str::slug($request->name);
        DB::table('products')->where('id', $id)->update([
            'name' => $request->name,
            'slug' => $slug,
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


