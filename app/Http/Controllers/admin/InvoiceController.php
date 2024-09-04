<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function show($id)
    {
        $invoice = Order::where('id', $id)->with('item','user')->first();
        return view('admin.pages.invoice.index',compact('invoice'));
    }
}
