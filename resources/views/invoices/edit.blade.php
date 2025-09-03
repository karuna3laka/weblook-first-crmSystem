@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">
    <h2 class="text-xl font-bold mb-4">Edit Invoice</h2>

    <form action="{{ route('invoices.update', $invoice) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-4">
            <label class="block mb-1">Customer</label>
            <select name="customer_id" class="w-full border rounded p-2">
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" @selected($invoice->customer_id == $customer->id)>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Amount</label>
            <input type="number" name="amount" step="0.01" value="{{ $invoice->amount }}" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Due Date</label>
            <input type="date" name="due_date" value="{{ $invoice->due_date }}" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Status</label>
            <select name="status" class="w-full border rounded p-2">
                <option value="draft" @selected($invoice->status == 'draft')>Draft</option>
                <option value="sent" @selected($invoice->status == 'sent')>Sent</option>
                <option value="paid" @selected($invoice->status == 'paid')>Paid</option>
                <option value="cancelled" @selected($invoice->status == 'cancelled')>Cancelled</option>
            </select>
        </div>

        <button class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">Update</button>
    </form>
</div>
@endsection
