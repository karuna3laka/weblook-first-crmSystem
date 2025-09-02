@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Customer</h1>

    <form method="POST" action="{{ route('customers.update', $customer->id) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $customer->name }}" class="w-full border p-2 rounded" required>
        <input type="email" name="email" value="{{ $customer->email }}" class="w-full border p-2 rounded" required>
        <input type="text" name="phone" value="{{ $customer->phone }}" class="w-full border p-2 rounded">
        <input type="text" name="company" value="{{ $customer->company }}" class="w-full border p-2 rounded">
        <input type="text" name="address" value="{{ $customer->address }}" class="w-full border p-2 rounded">
                <input type="text" name="address" value="{{ $customer->address }}" class="w-full border p-2 rounded">

        <select name="status" class="w-full border p-2 rounded">
            @foreach(\App\Models\Customer::STATUSES as $status)
                <option value="{{ $status }}" {{ $customer->status === $status ? 'selected' : '' }}>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="bg-black text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
