<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Customer;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('customer', 'invoice')->latest()->paginate(15);
        return view('transactions.index', compact('transactions'));
    }
}
