<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class FavoriteController extends Controller
{
    public function toggle(Request $request)
    {
        $userId = Auth::id();
        $productId = $request->product_id;

        $favorite = Favorite::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return back()->with('success', 'Đã bỏ yêu thích sản phẩm.');
        } else {
            Favorite::create([
                'user_id' => $userId,
                'product_id' => $productId
            ]);
            return back()->with('success', 'Đã thêm vào yêu thích.');
        }
    }



    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $favorites = Favorite::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('frontend.favorites.index', compact('favorites'));
    }
}
