<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use Psy\Util\Str;
use Yoeunes\Toastr\Facades\Toastr;

class ItemController extends Controller
{
    public function index()
    {
        $category = Category::latest()->get();
        $item = Item::latest()->get();
        return view('admin.pages.item.index', compact('category', 'item'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'qty' => 'required',
        ]);

        try {
            $item = new Item();
            $item->name = $request->name;
            $item->price = $request->price;
            $item->qty = $request->qty;
            $item->category_id = $request->category_id;
            //make every item add  code for as like barcode
            $item->barcode = 'ITM' . time();
            $item->save();
            Toastr::success('Item Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'qty' => 'required',
        ]);

        try {
            $item = Item::find($id);
            $item->name = $request->name;
            $item->price = $request->price;
            $item->qty = $request->qty;
            $item->category_id = $request->category_id;
            $item->status = $request->status;
            $item->save();

            Toastr::success('Item Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $item = Item::find($id);
            $item->delete();
            Toastr::success('Item Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function allOrder()
    {
        $orders = Order::with('item','user')->latest()->get();
        return view('admin.pages.item.orderList', compact('orders'));
    }
}
