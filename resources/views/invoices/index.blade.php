@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Invoices</h2>
        <a href="{{ route('invoices.create') }}" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">
            + Create Invoice
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 text-left">Invoice #</th>
                <th class="px-4 py-2 text-left">Customer</th>
                <th class="px-4 py-2 text-left">Amount</th>
                <th class="px-4 py-2 text-left">Status</th>
                <th class="px-4 py-2 text-left">Due Date</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        
        <tbody>
            @forelse($invoices as $invoice)
                <tr>
                    <td class="px-4 py-2">{{ $invoice->invoice_number }}</td>
                    <!-- // Added null check for customer -->
                   <td class="px-4 py-2">{{ $invoice->customer?->name ?? 'Customer Null' }}</td> 
                    <td class="px-4 py-2">${{ number_format($invoice->amount, 2) }}</td>
                    <td class="px-4 py-2">{{ ucfirst($invoice->status) }}</td>
                    <td class="px-4 py-2">{{ $invoice->due_date }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('invoices.edit', $invoice) }}" class="text-blue-600 hover:underline">Edit</a> |
                        <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Delete this invoice?')">
                                Delete
                            </button>
                        </form>
                        |
                        <form action="{{ route('invoices.send', $invoice) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-green-600 hover:underline" onclick="return confirm('Send this invoice?')">
                                Send
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-2 text-center text-gray-500">No invoices found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $invoices->links() }}</div>
</div>
@endsection


