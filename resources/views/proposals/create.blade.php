@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-900">Create Proposal</h1>

    <form action="{{ route('proposals.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold">Customer</label>
            <select name="customer_id" class="w-full border rounded p-2" required>
                <option value="">-- Select Customer --</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold">Title</label>
            <input type="text" name="title" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-semibold">Description</label>
            <textarea name="description" class="w-full border rounded p-2"></textarea>
        </div>

        <div>
            <label class="block font-semibold">Amount</label>
            <input type="number" name="amount" step="0.01" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-semibold">Status</label>
            <select name="status" class="w-full border rounded p-2">
                <option value="draft">Draft</option>
                <option value="sent">Sent</option>
                <option value="accepted">Accepted</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>

        <button type="submit" class="bg-black text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
