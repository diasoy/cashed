<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Order::query()->with('user');

        if ($search) {
            $query->where('customer', 'like', "%{$search}%")
                ->orWhere('payment', 'like', "%{$search}%")
                ->orWhere('total', 'like', "%{$search}%")
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        }

        $orders = $query->get();

        $totalPayment = $orders->sum('payment');
        $totalAmount = $orders->sum('total');

        return view('orders.index', [
            'orders' => $orders,
            'totalPayment' => $totalPayment,
            'totalAmount' => $totalAmount,
            'search' => $search,
        ]);
    }



    public function show(Order $order)
    {
        return view('orders.show', ['order' => $order]);
    }

    public function create(Request $request)
    {
        if (!session('order')) {
            $order = new Order();
            $order->customer = '-';
            $order->user_id = auth()->user()->id;

            session(['order' => $order]);
        }

        $categories = Category::query()->where('active', 1)->get();
        $productsQuery = Product::query()->where('active', 1);

        if ($request->category_id) {
            $productsQuery->where('category_id', $request->category_id);
        }

        if ($request->search) {
            $productsQuery->where('name', 'like', "%{$request->search}%");
        }

        $products = $productsQuery->get();

        return view('orders.create', [
            'categories' => $categories,
            'products' => $products,
        ])->with('success', 'Order berhasil ditambahkan!');
    }

    public function createDetail(Product $product)
    {
        $order = session('order');
        $detail = null;

        if (isset($order->details[$product->id])) {
            $detail = $order->details[$product->id];
        }

        return view('orders.create-detail', [
            'product' => $product,
            'detail' => $detail,
        ]);
    }

    public function storeDetail(Request $request, Product $product)
    {
        $order = session('order');

        if ($request->submit == 'destroy') {
            unset($order->details[$product->id]);
            return redirect()->route('orders.create');
        }

        $request->validate([
            'qty' => 'required|numeric|min:1',
            'price' => 'required|numeric',
        ]);

        $detail = new OrderDetail();
        $detail->product_id = $product->id;
        $detail->qty = $request->qty;
        $detail->price = $request->price;

        $order->details[$product->id] = $detail;

        return redirect()->route('orders.create');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'customer' => 'required',
            'payment' => 'required',
        ]);

        $order = session('order');
        $total = 0;

        foreach ($order->details as $detail) {
            $total += $detail->qty * $detail->price;
        }

        if ($request->payment < $total) {
            return back()->withInput()->withErrors(['payment' => 'Payment tidak mencukupi']);
        }

        $order->customer = $request->customer;
        $order->payment = $request->payment;
        $order->total = $total;
        $order->save();
        $order->details()->saveMany($order->details);

        $request->session()->forget('order');

        return redirect()->route('orders.show', ['order' => $order->id]);
    }

    public function destroy(Order $order)
    {
        $order->details()->delete();

        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order dan detailnya berhasil dihapus!');
    }
}
