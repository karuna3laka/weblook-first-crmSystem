@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-900">Edit Proposal</h1>

    <form action="{{ route('proposals.update', $proposal) }}" method="POST" class="space-y-4">
        @csrf @method('PUT')

        <div>
            <label class="block font-semibold">Customer</label>
            <select name="customer_id" class="w-full border rounded p-2" required>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" @if($customer->id == $proposal->customer_id) selected @endif>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold">Title</label>
            <input type="text" name="title" class="w-full border rounded p-2" value="{{ $proposal->title }}" required>
        </div>

        <div>
            <label class="block font-semibold">Description</label>
            <textarea name="description" class="w-full border rounded p-2">{{ $proposal->description }}</textarea>
        </div>

        <div>
            <label class="block font-semibold">Amount</label>
            <input type="number" name="amount" step="0.01" class="w-full border rounded p-2" value="{{ $proposal->amount }}" required>
        </div>

        <div>
            <label class="block font-semibold">Status</label>
            <select name="status" class="w-full border rounded p-2">
                <option value="draft" @if($proposal->status == 'draft') selected @endif>Draft</option>
                <option value="sent" @if($proposal->status == 'sent') selected @endif>Sent</option>
                <option value="accepted" @if($proposal->status == 'accepted') selected @endif>Accepted</option>
                <option value="rejected" @if($proposal->status == 'rejected') selected @endif>Rejected</option>
            </select>
        </div>

        <button type="submit" class="bg-black text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
