<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Throwable;

class CartController extends Controller
{
    /**
     * add to cart
     */
    public function addToCart(Request $request, string $id)
    {
        try {
            $quantity = $request->get('quantity', 1);
            $product = Product::findOrFail($id);
            if (!$product) {
                return "lỗi!";
            }

            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += $quantity;
            } else {
                $cart[$id] = [
                    'id' => $product->id,
                    'image' => $product->image,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                ];
            }
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Add To Cart Success!');
        } catch (Throwable $e) {
            return $e;
        }
    }

    /**
     * show cart
     */
    public function showCart()
    {
        try {
            $cart = session()->get('cart', []);

            if (empty($cart)) {;
                return view('home.cart');
            } else {
                return view('home.cart', compact('cart'));
            }
        } catch (Throwable $e) {
            return $e;
        }
    }

    /**
     * update cart
     */
    public function updateCart(Request $request, string $id)
    {
        $newQuantity = $request->input('quantity');
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $newQuantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Update Cart Success!');
        }
        return redirect()->back()->with('error', 'The product is not in the cart!');
    }

    /**
     * delete cart
     */
    public function deleteCart(string $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product removed from cart!');
    }

    /**
     * show item cart checkout
     */
    public function showCartCheckout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return view('checkout');
        } else {
            return view('checkout', compact('cart'));
        }
    }

    /**
     * handle checkout
     */
    public function handleCheckout(Request $request)
    {
        try {
            $value = $request->only(['user_id', 'name', 'email', 'address', 'phone', 'total_amount']);

            if ($value['address'] == null || $value['phone'] == null) {
                return redirect()->back()->with('warning', 'Please enter complete information!');
            } else {
                // Create the order
                $order = Order::create($request->only([
                    'address',
                    'total_amount',
                    'user_id'
                ]));
                //Reference(tham chiếu) to orderItems
                $cart = session()->get('cart');
                foreach ($cart as $item) {
                    $order->orderItems()->create([
                        'product_id' => $item['id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price']
                    ]);
                }
                session()->forget('cart');
                return redirect()->back()->with('success', 'You have placed your order successfully!');
            }
        } catch (Throwable $th) {
            return $th;
        }
    }
}
