@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">
    <h2 class="text-xl font-bold mb-4">Create Invoice</h2>

    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Customer</label>
            <select name="customer_id" class="w-full border rounded p-2">
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Amount</label>
            <input type="number" name="amount" step="0.01" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Due Date</label>
            <input type="date" name="due_date" class="w-full border rounded p-2">
        </div>

        <button class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">Save</button>
    </form>
</div>
@endsection
