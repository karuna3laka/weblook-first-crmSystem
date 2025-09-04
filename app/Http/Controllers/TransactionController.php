<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Customer;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::orderBy('name')->get(['id','name']);

        $query = Transaction::with(['customer','invoice'])->latest();

        // Optional filters
        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $transactions = $query->paginate(15)->withQueryString();

        return view('transactions.index', compact('transactions', 'customers'));
    }

    // Dedicated view for a single customer's transactions (optional direct link)
    public function byCustomer(Customer $customer, Request $request)
    {
        $transactions = $customer->transactions()
            ->with('invoice')
            ->latest()
            ->paginate(15);

        return view('transactions.by-customer', compact('transactions', 'customer'));
    }
}
