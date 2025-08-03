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
        $post = Post::with('postcategory', 'employee')
            ->where('isDeleted', 0)
            ->findOrFail($id);

        return view('admin.posts.show', compact('post'));
    }
}
