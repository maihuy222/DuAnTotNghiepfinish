<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    // Danh sách danh mục
    public function index()
    {
        $categories = Category::where('isDeleted', 0)->get();
        return view('admin.categories.index', compact('categories'));
    }

    // Form thêm
    public function create()
    {
        $categories = Category::where('isDeleted', 0)->get();
        return view('admin.categories.create', compact('categories'));
    }


    // Xử lý thêm mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('categories.index')->with('success', 'Thêm danh mục thành công');
    }

    // Form chỉnh sửa
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    // Xử lý cập nhật
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|max:100|unique:categories,name,' . $id,
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công');
    }

    // Xóa mềm
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->update(['isDeleted' => 1]);

        return redirect()->route('categories.index')->with('success', 'Đã xóa danh mục');
    }
}
