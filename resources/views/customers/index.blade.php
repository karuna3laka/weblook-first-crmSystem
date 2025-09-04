@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white rounded-xl shadow p-20 sm:p-6 lg:p-8">

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
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-200 min-w-[800px]">
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
                    <td class="border px-4 py-2 truncate max-w-[150px]">{{ $customer->name }}</td>
                    <td class="border px-4 py-2 truncate max-w-[200px]">{{ $customer->email }}</td>
                    <td class="border px-4 py-2 whitespace-nowrap">{{ $customer->phone }}</td>
                    <td class="border px-4 py-2 truncate max-w-[150px]">{{ $customer->company }}</td>
                    <td class="border px-4 py-2">
                        <span class="px-2 py-1 text-xs rounded 
                            {{ $customer->status === 'active' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                            {{ ucfirst($customer->status) }}
                        </span>
                    </td>
                    <td class="border px-4 py-2 flex flex-wrap gap-2">
                        <!-- Edit Button -->
                        <button onclick="openModal('edit-modal-{{ $customer->id }}')"
                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                            Edit
                        </button>

                        <!-- Delete -->
                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div id="edit-modal-{{ $customer->id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden">
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity duration-300" onclick="closeModal('edit-modal-{{ $customer->id }}')"></div>

                    <!-- Modal Content -->
                    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg transform scale-95 opacity-0 transition-all duration-300 z-10" onclick="event.stopPropagation()">
                        <h2 class="text-xl font-bold mb-4">Edit Customer</h2>
                        <form method="POST" action="{{ route('customers.update', $customer->id) }}" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <input type="text" name="name" value="{{ $customer->name }}" placeholder="Name" class="w-full border p-2 rounded" required>
                            <input type="email" name="email" value="{{ $customer->email }}" placeholder="Email" class="w-full border p-2 rounded" required>
                            <input type="text" name="phone" value="{{ $customer->phone }}" placeholder="Phone" class="w-full border p-2 rounded">
                            <input type="text" name="company" value="{{ $customer->company }}" placeholder="Company" class="w-full border p-2 rounded">
                            <input type="text" name="address" value="{{ $customer->address }}" placeholder="Address" class="w-full border p-2 rounded">
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
</div>

<!-- Create Modal -->
<div id="create-modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity duration-300" onclick="closeModal('create-modal')"></div>

    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg transform scale-95 opacity-0 transition-all duration-300 z-10" onclick="event.stopPropagation()">
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

<!-- JS for Modals -->
<script>
function openModal(id) {
    const modal = document.getElementById(id);
    const content = modal.querySelector('div.z-10');
    modal.classList.remove('hidden');
    setTimeout(() => {
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeModal(id) {
    const modal = document.getElementById(id);
    const content = modal.querySelector('div.z-10');
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    setTimeout(() => modal.classList.add('hidden'), 300);
}
</script>
@endsection
