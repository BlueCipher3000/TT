<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('cartItems')->orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
    }

    public function show($orderId)
    {
        // Eager load the 'cartItems' relationship
        $order = Order::with('cartItems')->find($orderId);

        // Pass the order to the view
        return view('order.show', compact('order'));
    }

    public function apiIndex()
    {
        return response()->json(Order::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'total_price' => 'required|numeric',
        ]);

        $order = Order::create([
            'total_price' => $request->total_price,
            'status' => 0,  // Default status as 'pending'
        ]);

        foreach ($request->items as $item) {
            CartItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'product_name' => $item['product_name'],
                'quantity' => $item['quantity'],
                'final_price' => $item['final_price'],
            ]);
        }

        return response()->json([
            'message' => 'Order placed successfully',
            'order' => $order,
        ], 201);
    }

    public function update(Request $request, Order $order)
    {
        // dd(request()->all());
        // dd($order);
        $request->validate([
            'status' => 'required|integer|in:0,1,2',
        ]);

        $order->update(['status' => (int) $request->status]);

        return back()->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }


    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success', 'Đơn hàng đã bị xóa.');
    }
}
