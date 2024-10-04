<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderEditRequest;
use App\Models\Order;
use App\Models\UserMeta;
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
            return ('An error occurred: ' . $e->getMessage());
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
            return ('An error occurred: ' . $e->getMessage());
        }
    }


    /**
     * Tra ve giao dien trang cap nhat 
     */
    public function edit(string $id)
    {
        try {
            $order = Order::findOrFail($id);

            return view('admin.orders.edit', compact('order'));
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * ham xu li cap nhat.
     */
    public function update(OrderEditRequest $request, string $id)
    {
        try {
            $validated = $request->validated();
            $order = Order::findOrFail($id);

            if ($order) {
                $order->update($validated);

                toastr()->timeOut(7000)->closeButton()->addSuccess('Order Updated Successfully!');
                return redirect()->back()->with('message-success', 'Success');
            }
            toastr()->timeOut(7000)->closeButton()->addError('Order Updated Fail!');
            return redirect()->back();
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Ham xu li xoa
     */
    public function destroy(string $id)
    {
        try {
            $order = Order::findOrFail($id);

            if ($order) {
                $order->delete($id);

                toastr()->timeOut(7000)->closeButton()->addSuccess('Order Delete Successfully!');
                return redirect()->route('dashboard.orders.index');
            }
            toastr()->timeOut(7000)->closeButton()->addError('Order Not Found!');
            return redirect()->back();
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }
}
