@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white rounded-xl shadow p-6">

    <h1 class="text-2xl font-bold mb-6 text-gray-900">Customers</h1>

    <!-- Add Customer Button -->
    <button onclick="openModal('create-modal')"
        class="bg-black text-white px-4 py-2 rounded mb-4 inline-block hover:bg-gray-800">
        + Add Customer
    </button>

    <!-- Success message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    <!-- Customers Table -->
    <table class="w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Phone</th>
                <th class="border px-4 py-2">Company</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td class="border px-4 py-2">{{ $customer->name }}</td>
                <td class="border px-4 py-2">{{ $customer->email }}</td>
                <td class="border px-4 py-2">{{ $customer->phone }}</td>
                <td class="border px-4 py-2">{{ $customer->company }}</td>
                <td class="border px-4 py-2">
                    <span class="px-2 py-1 text-xs rounded {{ $customer->status === 'active' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                        {{ ucfirst($customer->status) }}
                    </span>
                </td>
                <td class="border px-4 py-2 flex space-x-2">
                    <!-- Edit Button -->
                    <button onclick="openModal('edit-modal-{{ $customer->id }}')"
                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                        Edit
                    </button>

                    <!-- Delete -->
                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div id="edit-modal-{{ $customer->id }}" class="modal fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg transform scale-95 transition-transform duration-300">
                    <h2 class="text-xl font-bold mb-4">Edit Customer</h2>
                    <form method="POST" action="{{ route('customers.update', $customer->id) }}" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <input type="text" name="name" value="{{ $customer->name }}" class="w-full border p-2 rounded" required>
                        <input type="email" name="email" value="{{ $customer->email }}" class="w-full border p-2 rounded" required>
                        <input type="text" name="phone" value="{{ $customer->phone }}" class="w-full border p-2 rounded">
                        <input type="text" name="company" value="{{ $customer->company }}" class="w-full border p-2 rounded">
                        <input type="text" name="address" value="{{ $customer->address }}" class="w-full border p-2 rounded">
                        <select name="status" class="w-full border p-2 rounded">
                            <option value="lead" {{ $customer->status=='lead'?'selected':'' }}>Lead</option>
                            <option value="active" {{ $customer->status=='active'?'selected':'' }}>Active</option>
                            <option value="inactive" {{ $customer->status=='inactive'?'selected':'' }}>Inactive</option>
                        </select>
                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="closeModal('edit-modal-{{ $customer->id }}')" class="px-4 py-2 rounded border">Cancel</button>
                            <button type="submit" class="bg-black text-white px-4 py-2 rounded">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            @endforeach
        </tbody>
    </table>
</div>

<!-- Create Modal -->
<div id="create-modal" class="modal fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg transform scale-95 transition-transform duration-300">
        <h2 class="text-xl font-bold mb-4">Add Customer</h2>
        <form method="POST" action="{{ route('customers.store') }}" class="space-y-4">
            @csrf
            <input type="text" name="name" placeholder="Name" class="w-full border p-2 rounded" required>
            <input type="email" name="email" placeholder="Email" class="w-full border p-2 rounded" required>
            <input type="text" name="phone" placeholder="Phone" class="w-full border p-2 rounded">
            <input type="text" name="company" placeholder="Company" class="w-full border p-2 rounded">
            <input type="text" name="address" placeholder="Address" class="w-full border p-2 rounded">
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal('create-modal')" class="px-4 py-2 rounded border">Cancel</button>
                <button type="submit" class="bg-black text-white px-4 py-2 rounded">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal JS with iOS-style fade and zoom -->
<script>
    function openModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('opacity-0', 'pointer-events-none');
        const inner = modal.querySelector('div');
        inner.classList.remove('scale-95');
        inner.classList.add('scale-100');
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        const inner = modal.querySelector('div');
        inner.classList.remove('scale-100');
        inner.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('opacity-0', 'pointer-events-none');
        }, 300);
    }
</script>

@endsection
