<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\SaleModel;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('dashboard', [
            'title' => 'Dashboard',
            'productCount' => (new ProductModel())->countAll(),
            'customerCount' => (new CustomerModel())->countAll(),
            'staffCount' => (new UserModel())->countAll(),
            'saleCount' => (new SaleModel())->countAll(),
        ]);
    }
}