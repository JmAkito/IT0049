<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\ProductModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Throwable;

class SaleController extends BaseController
{
    public function index()
    {
        $db = db_connect();

        $sales = $db->table('sales s')
            ->select('s.id, s.quantity, s.total_price, s.created_at, p.name AS product_name, c.full_name AS customer_name, u.full_name AS staff_name')
            ->join('products p', 'p.id = s.product_id')
            ->join('customers c', 'c.id = s.customer_id')
            ->join('users u', 'u.id = s.sold_by')
            ->orderBy('s.created_at', 'DESC')
            ->get()
            ->getResultArray();

        return view('sales/index', [
            'title' => 'Sales History',
            'sales' => $sales,
        ]);
    }

    public function new()
    {
        $products = (new ProductModel())
            ->where('stock_quantity >', 0)
            ->orderBy('name', 'ASC')
            ->findAll();

        $customers = (new CustomerModel())
            ->orderBy('full_name', 'ASC')
            ->findAll();

        return view('sales/form', [
            'title' => 'Record a Sale',
            'products' => $products,
            'customers' => $customers,
        ]);
    }

    public function create()
    {
        if (! $this->validate([
            'product_id' => 'required|integer|greater_than[0]',
            'customer_id' => 'required|integer|greater_than[0]',
            'quantity' => 'required|integer|greater_than[0]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $productId = (int) $this->request->getPost('product_id');
        $customerId = (int) $this->request->getPost('customer_id');
        $quantity = (int) $this->request->getPost('quantity');
        $staffId = (int) session()->get('user_id');

        $productModel = new ProductModel();
        $customerModel = new CustomerModel();

        $product = $productModel->find($productId);
        $customer = $customerModel->find($customerId);

        if (! $product || ! $customer || $staffId < 1) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'The selected product, customer, or staff account could not be found.');
        }

        if ((int) $product['stock_quantity'] < $quantity) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'There is not enough stock for that quantity.');
        }

        $totalPrice = round((float) $product['price'] * $quantity, 2);
        $db = db_connect();

        try {
            $db->transBegin();

            $db->table('products')
                ->where('id', $productId)
                ->where('stock_quantity >=', $quantity)
                ->set('stock_quantity', 'stock_quantity - ' . $quantity, false)
                ->update();

            if ($db->affectedRows() !== 1) {
                $db->transRollback();

                return redirect()->back()
                    ->withInput()
                    ->with('error', 'The stock changed before the sale could be saved. Please try again.');
            }

            $db->table('sales')->insert([
                'product_id' => $productId,
                'customer_id' => $customerId,
                'sold_by' => $staffId,
                'quantity' => $quantity,
                'total_price' => $totalPrice,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            if (! $db->transStatus()) {
                $db->transRollback();

                return redirect()->back()
                    ->withInput()
                    ->with('error', 'The sale could not be saved.');
            }

            $db->transCommit();
        } catch (Throwable $exception) {
            $db->transRollback();

            return redirect()->back()
                ->withInput()
                ->with('error', 'The sale could not be completed. Please check the product stock and try again.');
        }

        return redirect()->to(site_url('sales'))
            ->with('success', 'Sale recorded and product stock updated.');
    }
}