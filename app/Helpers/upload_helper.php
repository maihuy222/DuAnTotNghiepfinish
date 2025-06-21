<?php

use Illuminate\Http\UploadedFile;

if (!function_exists('upload_file')) {
    function upload_file(UploadedFile $file, $target_dir = 'uploads/')
    {
        // Tạo thư mục nếu chưa tồn tại
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $result = [
            'status' => false,
            'name' => '',
            'error' => ''
        ];

        // Lấy phần mở rộng
        $ext = strtolower($file->getClientOriginalExtension());
        $allowed = ['jpg', 'jpeg', 'png', 'gif','webp'];

        // Kiểm tra định dạng hợp lệ
        if (!in_array($ext, $allowed)) {
            $result['error'] = "Chỉ chấp nhận file JPG, JPEG, PNG & GIF.";
            return $result;
        }

        // Kiểm tra dung lượng (tối đa 5MB)
        if ($file->getSize() > 5 * 1024 * 1024) {
            $result['error'] = "File quá lớn. Tối đa 5MB.";
            return $result;
        }

        // Tạo tên file mới để tránh trùng lặp
        $new_name = uniqid() . '.' . $ext;

        // Di chuyển file vào thư mục
        if ($file->move($target_dir, $new_name)) {
            $result['status'] = true;
            $result['name'] = $new_name;
        } else {
            $result['error'] = "Lỗi khi upload file.";
        }

        return $result;
    }
}
