<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Throwable;

class OrderItemController extends Controller
{
    /**
     * Tra ve giao dien trang chu 
     */
    public function index()
    {
        try {
            $orderItems = OrderItem::paginate(10);
            return view('admin.orderItems.index', compact('orderItems'));
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    
    /**
     * hien thi 
     */
    public function show(string $id)
    {
        try {
            $orderItem = OrderItem::findOrFail($id);
            return view('admin.orderItems.show', compact('orderItem'));
        } catch (Throwable $e) {
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
