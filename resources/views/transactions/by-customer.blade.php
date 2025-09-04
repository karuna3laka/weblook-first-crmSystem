@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Transactions — {{ $customer->name }}</h2>
        <a href="{{ route('transactions.index') }}" class="text-blue-600 hover:underline">← All transactions</a>
    </div>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 text-left">Payment ID</th>
                <th class="px-4 py-2 text-left">Invoice #</th>
                <th class="px-4 py-2 text-left">Amount</th>
                <th class="px-4 py-2 text-left">Status</th>
                <th class="px-4 py-2 text-left">Paid At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $t)
                <tr class="border-b">
                    <td class="px-4 py-2 font-mono text-sm">{{ $t->payment_id }}</td>
                    <td class="px-4 py-2">{{ $t->invoice?->invoice_number ?? 'N/A' }}</td>
                    <td class="px-4 py-2">${{ number_format($t->amount,2) }}</td>
                    <td class="px-4 py-2">{{ ucfirst($t->status) }}</td>
                    <td class="px-4 py-2">{{ $t->paid_at?->format('Y-m-d H:i') ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">No transactions yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $transactions->links() }}</div>
</div>
@endsection
