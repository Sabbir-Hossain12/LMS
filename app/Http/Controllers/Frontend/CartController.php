<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Course;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cartItems = Cart::with('course')->where('user_id', auth()->id())->get();

        if ($request->ajax()) {
            $cartItems->each(function ($item) {
                if ($item->course && $item->course->thumbnail_img) {
                    $item->course->thumbnail_img = asset($item->course->thumbnail_img);
                }
            });

            return response()->json(['success' => true, 'cartItem' => $cartItems]);
        }

        return view('Frontend.pages.checkout.cart', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
//        dd($request->all());
        $course = Course::findOrFail($request->course_id);
        $price = $course->sale_price;
        $quantity = $request->input('quantity', 1);
        $total = $price * $quantity;
        $cartItem = Cart::updateOrCreate([
            'user_id' => auth()->id(),
            'course_id' => $course->id,
        ],
            [
                'price' => $price,
                'quantity' => $quantity,
                'total' => $total,
            ]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'cartItem' => $cartItem]);
        }
        return redirect()->back()->with('success', 'Book added to cart successfully!');
    }

    public function updateQuantity(Request $request, $id)
    {
        $cartItem = Cart::where('user_id', auth()->id())->findOrFail($id);
        $quantity = $request->input('quantity');
        $cartItem->quantity = $quantity;
        $cartItem->total = $cartItem->price * $quantity;
        $cartItem->save();
        return response()->json(['success' => true, 'cartItem' => $cartItem]);
    }

    public function removeItem(Request $request, $id)
    {
        $cartItem = Cart::where('user_id', auth()->id())->findOrFail($id);
        $cartItem->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }
        
        return redirect()->back()->with('success', 'Item removed from cart successfully!');
    }

    public function clearCart()
    {
        Cart::where('user_id', auth()->id())->delete();
        return response()->json(['success' => true]);
    }
}
