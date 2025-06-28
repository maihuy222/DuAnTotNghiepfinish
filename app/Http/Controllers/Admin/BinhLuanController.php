<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;

class BinhLuanController extends Controller
{
    /**
     * Hiển thị danh sách bình luận
     */
    public function index()
    {
        // Lấy tất cả comments với thông tin user và post
        $comments = Comment::with(['user', 'post'])
            ->notDeleted()
            ->orderBy('created_at', 'desc')
            ->get();

        // Chuyển đổi dữ liệu để phù hợp với view
        $binhLuans = $comments->map(function ($comment) {
            return [
                'id' => $comment->id,
                'ten_nguoi_dung' => $comment->user ? $comment->user->name : 'Khách',
                'email' => $comment->user ? $comment->user->email : 'N/A',
                'noi_dung' => $comment->content,
                'san_pham' => $comment->post ? $comment->post->title : 'Sản phẩm không tồn tại',
                'ngay_binh_luan' => $comment->created_at->format('Y-m-d'),
                'trang_thai' => $this->getStatusText($comment->status),
                'diem_danh_gia' => 5, // Mặc định 5 sao, có thể thêm trường rating sau
                'status' => $comment->status
            ];
        });

        return view('admin.quanlybinhluan', compact('binhLuans'));
    }

    /**
     * Hiển thị chi tiết bình luận
     */
    public function show($id)
    {
        $comment = Comment::with(['user', 'post'])
            ->notDeleted()
            ->findOrFail($id);

        $binhLuan = [
            'id' => $comment->id,
            'ten_nguoi_dung' => $comment->user ? $comment->user->name : 'Khách',
            'email' => $comment->user ? $comment->user->email : 'N/A',
            'so_dien_thoai' => $comment->user ? ($comment->user->phone ?? 'N/A') : 'N/A',
            'noi_dung' => $comment->content,
            'san_pham' => $comment->post ? $comment->post->title : 'Sản phẩm không tồn tại',
            'ngay_binh_luan' => $comment->created_at->format('Y-m-d H:i:s'),
            'trang_thai' => $this->getStatusText($comment->status),
            'diem_danh_gia' => 5, // Mặc định 5 sao
            'hinh_anh' => $comment->post ? ($comment->post->image ?? 'default.jpg') : 'default.jpg',
            'phan_hoi' => $comment->reply, // Lấy phản hồi từ trường reply
            'status' => $comment->status
        ];

        return view('admin.chitietbinhluan', compact('binhLuan'));
    }

    /**
     * Cập nhật trạng thái bình luận
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $trangThai = $request->input('trang_thai');
            
            // Chuyển đổi trạng thái từ tiếng Việt sang tiếng Anh
            $status = $this->getStatusValue($trangThai);
            
            $comment->update(['status' => $status]);
            
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật trạng thái bình luận thành công!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Phản hồi bình luận
     */
    public function reply(Request $request, $id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $phanHoi = $request->input('phan_hoi');
            
            // Validate dữ liệu
            if (empty(trim($phanHoi))) {
                return response()->json([
                    'success' => false,
                    'message' => 'Nội dung phản hồi không được để trống!'
                ], 400);
            }
            
            // Lưu phản hồi vào trường reply
            $comment->update(['reply' => $phanHoi]);
            
            return response()->json([
                'success' => true,
                'message' => 'Phản hồi bình luận thành công!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Xóa bình luận
     */
    public function destroy($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            
            // Soft delete - chỉ đánh dấu là đã xóa
            $comment->update(['isDeleted' => 1]);
            
            return response()->json([
                'success' => true,
                'message' => 'Xóa bình luận thành công!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Chuyển đổi trạng thái từ tiếng Anh sang tiếng Việt
     */
    private function getStatusText($status)
    {
        switch ($status) {
            case 'approved':
                return 'Đã duyệt';
            case 'pending':
                return 'Chờ duyệt';
            case 'rejected':
                return 'Từ chối';
            default:
                return 'Chờ duyệt';
        }
    }

    /**
     * Chuyển đổi trạng thái từ tiếng Việt sang tiếng Anh
     */
    private function getStatusValue($trangThai)
    {
        switch ($trangThai) {
            case 'Đã duyệt':
                return 'approved';
            case 'Chờ duyệt':
                return 'pending';
            case 'Từ chối':
                return 'rejected';
            default:
                return 'pending';
        }
    }
} 