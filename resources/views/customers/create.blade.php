@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Add Customer</h1>

    <form method="POST" action="{{ route('customers.store') }}" class="space-y-4">
        @csrf
        <input type="text" name="name" placeholder="Name" class="w-full border p-2 rounded" required>
        <input type="email" name="email" placeholder="Email" class="w-full border p-2 rounded" required>
        <input type="text" name="phone" placeholder="Phone (Optional)" class="w-full border p-2 rounded">
        <input type="text" name="company" placeholder="Company (Optional)" class="w-full border p-2 rounded">
        <input type="text" name="address" placeholder="Address (Optional)" class="w-full border p-2 rounded">
        

        <button type="submit" class="bg-black text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
