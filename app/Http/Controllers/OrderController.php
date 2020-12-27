<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use PDO;
use PDOException;

class OrderController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function store()
    {
        $data = request()->validate([
            'quantity' => 'required',
            'product_id' => 'required|exists:products,id'
        ]);

        // Find Product Model
        $product = Product::findOrFail($id = $data['product_id']);

        // if Stocks < Quantity, return Error Response
        if (($avail_stock = $product['available_stock']) < ($qty = $data['quantity']))
            return $this->error('Failed to order this product due to unavailability of the stock', 400);

        // Create new Order Model
        Order::create($data);

        // Update Product Stocks
        $product->update(['available_stock' => $avail_stock - $qty]);

        return $this->response('You have successfully ordered this product.', 201);
    }
}
