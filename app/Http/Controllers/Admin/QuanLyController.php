<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuanLyController extends Controller
{
    function quanlynguoidung(){
        $users = DB::table('users')->get();
        return view('admin.quanlynguoidung',['users' => $users]);
    }
}
