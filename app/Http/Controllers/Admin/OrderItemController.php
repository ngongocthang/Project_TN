<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
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
            return ('An error occurred: ' . $e->getMessage());
        }
    }

    
    /**
     * hien thi 
     */
    public function show($id)
    {
        try {
            $orderItem = OrderItem::findOrFail($id);
            return view('admin.orderItems.show', compact('orderItem'));
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
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
