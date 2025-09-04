@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
        <h2 class="text-xl font-bold">Transactions</h2>

        <!-- Filters -->
        <form method="GET" class="flex flex-wrap items-end gap-3">
            <div>
                <label class="block text-sm text-gray-600">Customer</label>
                <select name="customer_id" class="border rounded px-3 py-2">
                    <option value="">All</option>
                    @foreach($customers as $c)
                        <option value="{{ $c->id }}" @selected(request('customer_id') == $c->id)>
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm text-gray-600">Status</label>
                <select name="status" class="border rounded px-3 py-2">
                    <option value="">All</option>
                    @foreach(['pending','paid','failed','refunded'] as $st)
                        <option value="{{ $st }}" @selected(request('status')===$st)>{{ ucfirst($st) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm text-gray-600">From</label>
                <input type="date" name="from" value="{{ request('from') }}" class="border rounded px-3 py-2">
            </div>

            <div>
                <label class="block text-sm text-gray-600">To</label>
                <input type="date" name="to" value="{{ request('to') }}" class="border rounded px-3 py-2">
            </div>

            <button type="submit" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">
                Filter
            </button>
        </form>
    </div>

    <!-- Responsive Table Wrapper -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse min-w-[800px]">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">Payment ID</th>
                    <th class="px-4 py-2 text-left">Customer</th>
                    <th class="px-4 py-2 text-left">Invoice #</th>
                    <th class="px-4 py-2 text-left">Amount</th>
                    <th class="px-4 py-2 text-left">Currency</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Paid At</th>
                    <th class="px-4 py-2 text-left">Created</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $t)
                    <tr class="border-b">
                        <td class="px-4 py-2 font-mono text-sm truncate max-w-[160px]">{{ $t->payment_id }}</td>
                        <td class="px-4 py-2 truncate max-w-[160px]">
                            @if($t->customer)
                                <a href="{{ route('customers.transactions', $t->customer) }}" class="text-blue-600 hover:underline">
                                    {{ $t->customer->name }}
                                </a>
                            @else
                                <span class="text-gray-500">N/A</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 truncate max-w-[140px]">{{ $t->invoice?->invoice_number ?? 'N/A' }}</td>
                        <td class="px-4 py-2 whitespace-nowrap">${{ number_format($t->amount,2) }}</td>
                        <td class="px-4 py-2 whitespace-nowrap">{{ strtoupper($t->currency) }}</td>
                        <td class="px-4 py-2">
                            @php
                                $color = [
                                    'paid' => 'bg-green-100 text-green-700',
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'failed' => 'bg-red-100 text-red-700',
                                    'refunded' => 'bg-blue-100 text-blue-700',
                                ][$t->status] ?? 'bg-gray-100 text-gray-700';
                            @endphp
                            <span class="px-2 py-1 rounded text-sm {{ $color }}">{{ ucfirst($t->status) }}</span>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap">{{ $t->paid_at?->format('Y-m-d H:i') ?? '-' }}</td>
                        <td class="px-4 py-2 text-gray-600 text-sm whitespace-nowrap">{{ $t->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-500">No transactions found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $transactions->links() }}</div>
</div>
@endsection
