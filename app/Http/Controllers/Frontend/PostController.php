<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Employee;
class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('postcategory', 'employee')
            ->where('isDeleted', 0)
            ->latest()
            ->get();

        return view('adminposts.index', compact('posts'));
    }

    // Hiển thị chi tiết bài viết
    public function show($id)
    {
        $post = Post::with('author', 'category')->findOrFail($id);

        // Lấy 5 bài viết khác cùng danh mục, trừ bài hiện tại
        $ChitietPosts = Post::where('category_id', $post->category_id)
            ->where('id', '<>', $id)
            ->latest()
            ->take(5)
            ->get();

        return view('frontend.blog.show', compact('post', 'ChitietPosts'));
    }
}
