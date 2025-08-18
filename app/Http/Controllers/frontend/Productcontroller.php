<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Review;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class Productcontroller extends Controller
{
    public function show($slug)
    {
        // Dùng Eloquent, load luôn quan hệ reviews và images
        $product = Product::with(['category', 'reviews', 'images','sizes'])
            ->where('slug', $slug)
            ->firstOrFail();
        
        // Load comments cho sản phẩm này
        $comments = Comment::with('user')
            ->where('post_id', $product->id)
            ->where('isDeleted', 0)
            ->where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->get();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('frontend.products.product_detail', compact('product', 'relatedProducts', 'comments'));
    }

    public function index()
    {
        $products = DB::table('products')
            ->where('isDeleted', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.products.index', compact('products'));
    }

    public function addComment(Request $request, $productId)
    {
        Log::info('Comment request received', [
            'product_id' => $productId,
            'user_id' => Auth::id(),
            'content' => $request->content,
            'method' => $request->method(),
            'headers' => $request->headers->all()
        ]);

        // Kiểm tra user đã đăng nhập chưa
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng đăng nhập để bình luận!'
            ], 401);
        }

        // Validate dữ liệu
        $request->validate([
            'content' => 'required|string|max:500'
        ], [
            'content.required' => 'Vui lòng nhập nội dung bình luận!',
            'content.max' => 'Bình luận không được quá 500 ký tự!'
        ]);

        try {
            // Kiểm tra product có tồn tại không
            $product = Product::find($productId);
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sản phẩm không tồn tại!'
                ], 404);
            }

            // Sử dụng Comment model để lưu vào bảng comments
            $comment = Comment::create([
                'post_id' => $productId, // Sử dụng product ID như post_id
                'user_id' => Auth::id(),
                'content' => $request->content,
                'status' => 'approved',
                'isDeleted' => 0
            ]);

            // Load thông tin user
            $comment->load('user');

            Log::info('Comment saved to database', [
                'comment_id' => $comment->id,
                'product_id' => $productId,
                'user_id' => Auth::id(),
                'content' => $request->content
            ]);

            Log::info('Comment created successfully', [
                'comment_id' => $comment->id,
                'product_id' => $productId,
                'user_id' => Auth::id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Bình luận đã được gửi thành công!',
                'comment' => [
                    'id' => $comment->id,
                    'content' => $request->content,
                    'user_name' => $comment->user->name,
                    'created_at' => $comment->created_at->format('d/m/Y H:i')
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error creating comment: ' . $e->getMessage(), [
                'product_id' => $productId,
                'user_id' => Auth::id(),
                'content' => $request->content,
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra, vui lòng thử lại!'
            ], 500);
        }
    }

    public function addReview(Request $request, $productId)
    {
        // Yêu cầu đăng nhập
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng đăng nhập để đánh giá!'
            ], 401);
        }

        // Validate rating 1-5 và content tuỳ chọn
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'nullable|string|max:500'
        ], [
            'rating.required' => 'Vui lòng chọn số sao đánh giá!',
            'rating.min' => 'Số sao tối thiểu là 1!',
            'rating.max' => 'Số sao tối đa là 5!'
        ]);

        // Kiểm tra sản phẩm
        $product = Product::find($productId);
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Sản phẩm không tồn tại!'
            ], 404);
        }

        // Tạo hoặc cập nhật review của user cho sản phẩm này (mỗi user 1 review)
        $review = Review::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $productId,
            ],
            [
                'content' => $request->input('content'),
                'rating' => (int) $request->input('rating'),
                'isDeleted' => 0,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Đã lưu đánh giá của bạn!',
            'data' => [
                'id' => $review->id,
                'rating' => $review->rating,
                'content' => $review->content,
                'updated_at' => $review->updated_at->format('d/m/Y H:i')
            ]
        ]);
    }
}
