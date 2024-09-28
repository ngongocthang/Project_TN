<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Throwable;

class OrderController extends Controller
{
    /**
     * Tra ve giao dien trang chu 
     */
    public function index()
    {
        try {
            $orders = Order::paginate(10);
            return view('admin.orders.index', compact('orders'));
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * hien thi order
     */
    public function show(string $id)
    {
        try {
            $order = Order::findOrFail($id);
            return view('admin.orders.show', compact('order'));
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Ham xu li xoa
     */
    public function destroy(string $id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->orderItems()->delete();
            $order->delete($id);
            if($order){
                toastr()->timeOut(7000)->closeButton()->addSuccess('Order Delete Successfully!');
                return redirect()->back();
            }
            toastr()->timeOut(7000)->closeButton()->addError('Order Not Found!');
            return redirect()->back();
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
