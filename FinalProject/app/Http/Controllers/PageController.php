<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('dashboard', [
            'productCount' => Product::where('is_active', true)->count(),
            'customerCount' => Customer::count(),
            'staffCount' => User::count(),
            'todayTotal' => Sale::whereDate('created_at', today())->sum('total_price'),
            'latestSales' => Sale::with(['product', 'customer', 'staff'])->latest()->take(6)->get(),
            'lowStock' => Product::where('is_active', true)->where('stock_quantity', '<=', 5)->orderBy('stock_quantity')->take(5)->get(),
        ]);
    }

    public function about(): View
    {
        return view('about');
    }
}
