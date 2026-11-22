<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View { return view('customers.index', ['customers' => Customer::orderBy('full_name')->get()]); }
    public function create(): View { return view('customers.form', ['customer' => new Customer(), 'heading' => 'Add customer']); }
    public function store(Request $request): RedirectResponse
    {
        Customer::create($this->validated($request));
        return redirect()->route('customers.index')->with('success', 'Customer added.');
    }
    public function edit(Customer $customer): View { return view('customers.form', ['customer' => $customer, 'heading' => 'Edit customer']); }
    public function update(Request $request, Customer $customer): RedirectResponse
    {
        $customer->update($this->validated($request, $customer));
        return redirect()->route('customers.index')->with('success', 'Customer updated.');
    }
    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted. Past sales are kept without a customer link.');
    }
    private function validated(Request $request, ?Customer $customer = null): array
    {
        return $request->validate([
            'full_name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150', 'unique:customers,email'.($customer ? ','.$customer->id : '')],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);
    }
}
