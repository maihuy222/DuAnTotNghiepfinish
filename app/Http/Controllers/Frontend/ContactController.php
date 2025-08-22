<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact; // bạn sẽ tạo model lưu contact
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Hiển thị form
    public function index()
    {
        return view('frontend.contact.index');
    }

    // Xử lý form gửi đi
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string',
        ]);

        // Lưu vào DB
        Contact::create($request->only('name', 'email', 'message'));

        // (Tùy chọn) Gửi mail thông báo
        // Mail::to('admin@takexx.com')->send(new ContactMail($request->all()));

        return view('frontend.contact.send')->with('success', 'Cảm ơn bạn đã liên hệ, chúng tôi sẽ phản hồi sớm!');
    }
}
