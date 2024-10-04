<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Throwable;

class DataController extends Controller
{
    /**
     * data repost
     */
    public function repost()
    {
        try {
            $orders = Order::selectRaw('status, count(*) as count, DATE(created_at) as date')
                ->groupBy('status', 'date')
                ->get();

            $pendingOrders = $orders->where('status', 'pending')->pluck('count', 'date')->toArray();
            $paidOrders = $orders->where('status', 'paid')->pluck('count', 'date')->toArray();
            $canceledOrders = $orders->where('status', 'canceled')->pluck('count', 'date')->toArray();

            $allDates = array_unique(array_merge(array_keys($pendingOrders), array_keys($paidOrders), array_keys($canceledOrders)));
            sort($allDates);

            return response()->json([
                'pendingOrders' => $pendingOrders,
                'paidOrders' => $paidOrders,
                'canceledOrders' => $canceledOrders,
                'dates' => $allDates,
            ]);
        } catch (Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * data stock
     */
    public function stock()
{
    try {
        $pendingOrders = Order::where('status', 'pending')->count();
        $paidOrders = Order::where('status', 'paid')->count();
        $canceledOrders = Order::where('status', 'canceled')->count();
        

        return response()->json([
            'pending' => $pendingOrders,
            'paid' => $paidOrders,
            'canceled' => $canceledOrders,
           
        ]);
    } catch (\Throwable $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
}
