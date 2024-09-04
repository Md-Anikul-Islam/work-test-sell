<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $category = Category::latest()->get();
        $item = Item::where('qty', '>', 0)->latest()->get();
        $myOrders = Order::where('user_id', auth()->id())->with('item','user')->latest()->get();
        return view('admin.pages.order.index', compact('category', 'item', 'myOrders'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'qty' => 'required|integer|min:1',
        ]);
        // Get the item from the database
        $item = Item::find($request->item_id);
        // Check if the requested quantity is available
        if ($request->qty > $item->qty) {
            return redirect()->back()->with('error', 'Not Found Available stock.');
        }
        // Store the order in the orders table
        Order::create([
            'user_id' => auth()->id(), // Assuming you have authentication
            'item_id' => $request->item_id,
            'qty' => $request->qty, // Assuming you add this column to orders table
        ]);
        // Update the item quantity in the items table
        $item->decrement('qty', $request->qty);

        return redirect()->back()->with('success', 'Order placed successfully and stock updated.');
    }
}
