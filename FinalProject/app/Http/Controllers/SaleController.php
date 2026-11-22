<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class SaleController extends Controller
{
    public function index(): View
    {
        return view('sales.index', ['sales' => Sale::with(['product', 'customer', 'staff'])->latest()->paginate(15)]);
    }

    public function create(): View
    {
        return view('sales.create', [
            'products' => Product::where('is_active', true)->where('stock_quantity', '>', 0)->orderBy('name')->get(),
            'customers' => Customer::orderBy('full_name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'customer_id' => ['nullable', 'integer', 'exists:customers,id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:2147483647'],
        ]);

        DB::transaction(function () use ($data): void {
            $product = Product::whereKey($data['product_id'])->firstOrFail();
            if (! $product->is_active) throw ValidationException::withMessages(['product_id' => 'This product is archived and cannot be sold.']);
            $total = round((float) $product->price * (int) $data['quantity'], 2);
            if ($total > 99999999.99) throw ValidationException::withMessages(['quantity' => 'The sale total is above the supported amount.']);
            $changed = Product::whereKey($product->id)->where('is_active', true)
                ->where('stock_quantity', '>=', $data['quantity'])
                ->decrement('stock_quantity', $data['quantity']);
            if ($changed !== 1) throw ValidationException::withMessages(['quantity' => 'There is not enough stock for that quantity. No sale was recorded.']);

            Sale::create([
                'product_id' => $product->id,
                'customer_id' => $data['customer_id'] ?? null,
                'sold_by' => auth()->id(),
                'quantity' => $data['quantity'],
                'total_price' => $total,
            ]);
        });

        return redirect()->route('sales.index')->with('success', 'Sale recorded and inventory updated.');
    }
}
