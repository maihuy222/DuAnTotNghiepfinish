<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    /**
     * Hiển thị danh sách slider
     */
    public function index()
    {
        $sliders = Slider::active()->orderBy('created_at', 'desc')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Hiển thị form tạo slider mới
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Lưu slider mới
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url|max:255',
        ], [
            'title.required' => 'Tiêu đề không được để trống',
            'title.max' => 'Tiêu đề không được quá 100 ký tự',
            'image.required' => 'Hình ảnh không được để trống',
            'image.image' => 'File phải là hình ảnh',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif',
            'image.max' => 'Hình ảnh không được quá 2MB',
            'link.url' => 'Link không đúng định dạng URL',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Xử lý upload hình ảnh
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('sliders', $imageName, 'public');
            }

            // Tạo slider mới
            $slider = Slider::create([
                'title' => $request->title,
                'image' => $imagePath,
                'link' => $request->link,
                'isDeleted' => false
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thêm slider thành công',
                'data' => $slider
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Hiển thị form chỉnh sửa slider
     */
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * Cập nhật slider
     */
    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url|max:255',
        ], [
            'title.required' => 'Tiêu đề không được để trống',
            'title.max' => 'Tiêu đề không được quá 100 ký tự',
            'image.image' => 'File phải là hình ảnh',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif',
            'image.max' => 'Hình ảnh không được quá 2MB',
            'link.url' => 'Link không đúng định dạng URL',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = [
                'title' => $request->title,
                'link' => $request->link,
            ];

            // Xử lý upload hình ảnh mới nếu có
            if ($request->hasFile('image')) {
                // Xóa hình ảnh cũ
                if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                    Storage::disk('public')->delete($slider->image);
                }

                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('sliders', $imageName, 'public');
                $data['image'] = $imagePath;
            }

            $slider->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật slider thành công',
                'data' => $slider
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Xóa slider (soft delete)
     */
    public function destroy($id)
    {
        try {
            $slider = Slider::findOrFail($id);
            $slider->update(['isDeleted' => true]);

            return response()->json([
                'success' => true,
                'message' => 'Xóa slider thành công'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Khôi phục slider đã xóa
     */
    public function restore($id)
    {
        try {
            $slider = Slider::findOrFail($id);
            $slider->update(['isDeleted' => false]);

            return response()->json([
                'success' => true,
                'message' => 'Khôi phục slider thành công'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Xóa vĩnh viễn slider
     */
    public function forceDelete($id)
    {
        try {
            $slider = Slider::findOrFail($id);
            
            // Xóa hình ảnh
            if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                Storage::disk('public')->delete($slider->image);
            }
            
            $slider->delete();

            return response()->json([
                'success' => true,
                'message' => 'Xóa vĩnh viễn slider thành công'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bật/tắt trạng thái hiển thị slider
     */
    public function toggleActive($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->is_active = !$slider->is_active;
        $slider->save();

        return response()->json([
            'success' => true,
            'message' => $slider->is_active ? 'Đã hiển thị slider!' : 'Đã ẩn slider!',
            'is_active' => $slider->is_active
        ]);
    }
} 