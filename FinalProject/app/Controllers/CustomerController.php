<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Throwable;

class CustomerController extends BaseController
{
    private CustomerModel $customers;

    public function __construct()
    {
        $this->customers = new CustomerModel();
    }

    public function index()
    {
        return view('customers/index', [
            'title' => 'Customers',
            'customers' => $this->customers->orderBy('id', 'DESC')->findAll(),
        ]);
    }

    public function new()
    {
        return view('customers/form', [
            'title' => 'Add Customer',
            'customer' => [
                'id' => '',
                'full_name' => '',
                'email' => '',
                'phone' => '',
            ],
            'formAction' => site_url('customers'),
            'buttonText' => 'Save Customer',
        ]);
    }

    public function create()
    {
        if (! $this->validate($this->customerRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $saved = $this->customers->insert([
                'full_name' => trim((string) $this->request->getPost('full_name')),
                'email' => trim((string) $this->request->getPost('email')),
                'phone' => trim((string) $this->request->getPost('phone')) ?: null,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        } catch (Throwable $exception) {
            $saved = false;
        }

        if (! $saved) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'The customer could not be saved. Check that the email is not already in use.');
        }

        return redirect()->to(site_url('customers'))
            ->with('success', 'Customer added successfully.');
    }

    public function edit(int $id)
    {
        $customer = $this->customers->find($id);

        if (! $customer) {
            throw PageNotFoundException::forPageNotFound('Customer not found.');
        }

        return view('customers/form', [
            'title' => 'Edit Customer',
            'customer' => $customer,
            'formAction' => site_url('customers/' . $id . '/update'),
            'buttonText' => 'Update Customer',
        ]);
    }

    public function update(int $id)
    {
        $customer = $this->customers->find($id);

        if (! $customer) {
            throw PageNotFoundException::forPageNotFound('Customer not found.');
        }

        if (! $this->validate($this->customerRules($id))) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $saved = $this->customers->update($id, [
                'full_name' => trim((string) $this->request->getPost('full_name')),
                'email' => trim((string) $this->request->getPost('email')),
                'phone' => trim((string) $this->request->getPost('phone')) ?: null,
            ]);
        } catch (Throwable $exception) {
            $saved = false;
        }

        if (! $saved) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'The customer could not be updated. Check that the email is not already in use.');
        }

        return redirect()->to(site_url('customers'))
            ->with('success', 'Customer updated successfully.');
    }

    public function delete(int $id)
    {
        $customer = $this->customers->find($id);

        if (! $customer) {
            throw PageNotFoundException::forPageNotFound('Customer not found.');
        }

        try {
            $deleted = $this->customers->delete($id);
        } catch (Throwable $exception) {
            return redirect()->to(site_url('customers'))
                ->with('error', 'This customer could not be deleted. They may be linked to a sale.');
        }

        if (! $deleted) {
            return redirect()->to(site_url('customers'))
                ->with('error', 'The customer could not be deleted.');
        }

        return redirect()->to(site_url('customers'))
            ->with('success', 'Customer deleted successfully.');
    }

    private function customerRules(?int $id = null): array
    {
        $emailRule = 'required|valid_email|max_length[100]|is_unique[customers.email]';

        if ($id !== null) {
            $emailRule = "required|valid_email|max_length[100]|is_unique[customers.email,id,{$id}]";
        }

        return [
            'full_name' => 'required|max_length[100]',
            'email' => $emailRule,
            'phone' => 'permit_empty|max_length[20]',
        ];
    }
}