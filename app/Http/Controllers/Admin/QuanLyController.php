<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class QuanLyController extends Controller
{
    function quanlynguoidung(){
        $users = DB::table('users')->get();
        return view('admin.user.quanlynguoidung',['users' => $users]);
    }
    function create(){
        return view('admin.user.create');
    }
    function store(Request $request){
        $request->validate([
            'name'=> 'required|string|max:100',
            'email' =>'required|email|unique:users,email',
            'address' => 'required|string|max:200',
            "password" => 'required|string|',
        ]);
        User::create([
            "name" => $request->name,
            "email" =>$request->email,
            "address" =>$request->address,
            "password" => Hash::make($request->password),

        ]);
        return redirect()->route('admin.quanly.nguoidung')->with('message', 'tạo người dùng thành công thành công');
    }
}
