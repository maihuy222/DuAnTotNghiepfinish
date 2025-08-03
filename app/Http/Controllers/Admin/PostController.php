<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Employee;

class PostController extends Controller
{
    // Hiển thị danh sách bài viết
    public function index()
    {
        $posts = Post::with('postcategory', 'employee')->where('isDeleted', 0)->latest()->get();

        return view('admin.posts.index', compact('posts'));
    }

    // Hiển thị form thêm mới
    public function create()
    {
        $categories = PostCategory::all();
        $employees = Employee::all();
        return view('admin.posts.create', compact('categories', 'employees'));
    }

    // Lưu bài viết mới
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:200',
            'content' => 'required',
            'image' => 'nullable|image',
            'category_id' => 'nullable|exists:postcategories,id',
            'employee_id' => 'nullable|exists:employees,id',
        ]);

        $data = $request->only(['title', 'content', 'category_id', 'employee_id']);

        // Xử lý ảnh
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/posts', 'public');
        }

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Thêm bài viết thành công!');
    }

    // Hiển thị form sửa
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = PostCategory::all();
        $employees = Employee::all();
        return view('admin.posts.edit', compact('post', 'categories', 'employees'));
    }

    // Cập nhật bài viết
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:200',
            'content' => 'required',
            'image' => 'nullable|image',
            'category_id' => 'nullable|exists:postcategories,id',
            'employee_id' => 'nullable|exists:employees,id',
        ]);

        $post = Post::findOrFail($id);
        $data = $request->only(['title', 'content', 'category_id', 'employee_id']);

        // Cập nhật ảnh nếu có
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/posts', 'public');
        }

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Cập nhật bài viết thành công!');
    }

    // Xóa bài viết (đánh dấu isDeleted)
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->update(['isDeleted' => 1]);

        return redirect()->route('admin.posts.index')->with('success', 'Đã xóa bài viết!');
    }
}
