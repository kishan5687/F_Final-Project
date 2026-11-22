<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;

class SaleController extends Controller
{
    public function record()
    {
        $products = Product::all();
        $customers = Customer::all();

        return view('sales.record', compact('products', 'customers'));
    }

    public function store(Request $request)
    {
        $productId = $request->input('product_id');
        $customerId = $request->input('customer_id');
        $quantity = (int) $request->input('quantity');

        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        if ($quantity > $product->stock_quantity) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Sale rejected: Requested quantity exceeds available stock.');
        }

        if ($quantity < 1) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Sale rejected: Quantity must be at least 1.');
        }

        $totalPrice = $product->price * $quantity;

        DB::transaction(function () use ($product, $productId, $customerId, $quantity, $totalPrice) {

            Sale::create([
                'product_id' => $productId,
                'customer_id' => !empty($customerId) ? $customerId : null,
                'sold_by' => session()->get('id'),
                'quantity' => $quantity,
                'total_price' => $totalPrice,
                'created_at' => now(),
            ]);

            $product->stock_quantity = $product->stock_quantity - $quantity;
            $product->save();
        });

        return redirect('/sales/history')
            ->with('success', 'Sale processed successfully.');
    }

    public function history()
    {
        $saleModel = new Sale();

        $sales = $saleModel->getSalesHistory();

        return view('sales.history', compact('sales'));
    }
}
