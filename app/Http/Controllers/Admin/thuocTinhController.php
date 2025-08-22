<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sizes;

class thuocTinhController extends Controller
{
    function index(){
        $datas = Sizes::all();
        return view('admin.thuocTinh.index',compact('datas'));
    }
    function create(){
        return view('admin.thuocTinh.create');
    }
    function store(Request $request){
        $request ->validate([
            'name' => 'required|string'
        ]);
        $data = Sizes::create([
            'name' => $request->get('name')
        ]);
        return redirect()->route('admin.thuoctinh')
        ->with('success','thêm thuộc tính thành công');
    }
    function edit($id){
        $data = Sizes::find($id);
        return view('admin.thuoctinh.edit',compact('data'));
    }
    function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $data = Sizes::findOrFail($id);
        $data->update([
            'name' => $request->get('name'),
            'show_in_nav' => $request->has('show_in_nav') ? 1 : 0,
        ]);

        return redirect()->route('admin.thuoctinh')
            ->with('success', 'Cập nhật thành công');
    }
    function destroy($id){
        $data = Sizes::find($id);
        $data->delete();
            return back()->with('success', 'xóa thành công');      
    }
    function destroyAll(){
        Sizes::query()->delete();
        return back()->with('success', 'xóa  hết thành công');
    }
    
}
