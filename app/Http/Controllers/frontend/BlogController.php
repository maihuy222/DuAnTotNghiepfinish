<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    // Hiển thị danh sách bài viết
    public function index()
    {
        $posts = Post::with(['category', 'author'])
            ->where('isDeleted', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
      


        return view('frontend.blog.index', compact('posts'));
    }

    // Hiển thị chi tiết bài viết
    public function show($id)
    {
        $post = Post::with(['category', 'author'])->findOrFail($id);

        return view('frontend.blog.show', compact('post'));
    }
    
}
