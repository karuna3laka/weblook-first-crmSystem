<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Http\Request;

use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Checkout\Session as CheckoutSession;
use Stripe\StripeClient;



class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('customer')->latest()->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('invoices.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
        ]);

        Invoice::create([
            'customer_id' => $request->customer_id,
            'invoice_number' => 'INV-' . time(),
            'amount' => $request->amount,
            'due_date' => $request->due_date,
            'status' => 'draft',
        ]);

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
    }

    public function edit(Invoice $invoice)
    {
        $customers = Customer::all();
        return view('invoices.edit', compact('invoice', 'customers'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'status' => 'required|in:draft,sent,paid,cancelled',
        ]);

        $invoice->update($request->all());

        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }

    public function sendInvoice($id)
{
    $invoice = Invoice::with('customer')->findOrFail($id);

    // Create Stripe Checkout session
    $stripe = new StripeClient(env('STRIPE_SECRET'));
    $session = $stripe->checkout->sessions->create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => 'Invoice #' . $invoice->invoice_number,
                ],
                'unit_amount' => $invoice->amount * 100,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => route('invoices.success', $invoice->id),
        'cancel_url' => route('invoices.index'),
        'metadata' => [
            'invoice_id' => $invoice->id,
        ],
    ]);

    $paymentUrl = $session->url;

    // Send email
    Mail::to($invoice->customer->email)->send(new InvoiceMail($invoice, $paymentUrl));

    return back()->with('success', 'Invoice email sent successfully.');
}


public function paymentSuccess(Invoice $invoice)
{
    $invoice->update(['status' => 'paid']);
    return redirect()->route('invoices.index')->with('success', 'Invoice paid successfully.');
}



}
