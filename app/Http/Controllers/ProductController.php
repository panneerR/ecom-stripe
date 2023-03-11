<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Session;
use Stripe;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $data = Product::all();
        return view('product.index', compact('data'));
    }

    public function checkOut(Request $request, $id)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

        $item = Product::find($id);
        $items = [
            [
                'price_data' => [
                  'currency' => 'inr',
                  'product_data' => [
                    'name' => $item->name,
                    'description' => $item->description,
                  ],
                  'unit_amount' => $item->price * 100,
                ],
                'quantity' => 1,
            ]
        ]; 

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $items,
            'mode' => 'payment',
            'success_url' => route('success',[],true),
            'cancel_url' =>  route('cancel',[],true),
        ]);

        $order = new Order();
        $order->status = 'paid';
        $order->total_amount = $item->price;
        $order->session_id = $checkout_session->id;
        $order->save();

        return redirect($checkout_session->url);
    }

    public function success()
    {
        return view('product.success');
    }

    public function cancel()
    {
        // code...
    }
}
