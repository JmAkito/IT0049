<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('products.index', ['products' => Product::orderByDesc('is_active')->orderBy('name')->get()]);
    }

    public function create(): View
    {
        return view('products.form', ['product' => new Product(), 'heading' => 'Add product']);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        if ($request->hasFile('image')) $data['image'] = $request->file('image')->store('products', 'public');
        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Product added.');
    }

    public function edit(Product $product): View
    {
        return view('products.form', ['product' => $product, 'heading' => 'Edit product']);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $this->validated($request, $product);
        $oldImage = $product->image;
        if ($request->hasFile('image')) $data['image'] = $request->file('image')->store('products', 'public');
        $product->update($data);
        if (isset($data['image']) && $oldImage) Storage::disk('public')->delete($oldImage);
        return redirect()->route('products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->sales()->exists()) {
            $product->update(['is_active' => false]);
            $message = 'Product archived because it appears in sales history.';
        } else {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $product->delete();
            $message = 'Product deleted.';
        }
        return redirect()->route('products.index')->with('success', $message);
    }

    private function validated(Request $request, ?Product $product = null): array
    {
        $unique = 'unique:products,name'.($product ? ','.$product->id : '');
        return $request->validate([
            'name' => ['required', 'string', 'max:120', $unique],
            'price' => ['required', 'numeric', 'min:0.01', 'max:99999999.99'],
            'stock_quantity' => ['required', 'integer', 'min:0', 'max:2147483647'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);
    }
}
