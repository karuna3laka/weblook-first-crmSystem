@foreach($customers as $customer)
<div id="edit-modal-{{ $customer->id }}" class="modal fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg transform scale-95 transition-transform duration-300">
        <h2 class="text-xl font-bold mb-6">Edit Customer</h2>
        <form method="POST" action="{{ route('customers.update', $customer->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <input type="text" name="name" value="{{ $customer->name }}" class="w-full border p-3 rounded" placeholder="Name" required>
            <input type="email" name="email" value="{{ $customer->email }}" class="w-full border p-3 rounded" placeholder="Email" required>
            <input type="text" name="phone" value="{{ $customer->phone }}" class="w-full border p-3 rounded" placeholder="Phone">
            <input type="text" name="company" value="{{ $customer->company }}" class="w-full border p-3 rounded" placeholder="Company">
            <input type="text" name="address" value="{{ $customer->address }}" class="w-full border p-3 rounded" placeholder="Address">
            
            <select name="status" class="w-full border p-3 rounded">
                <option value="lead" {{ $customer->status=='lead'?'selected':'' }}>Lead</option>
                <option value="active" {{ $customer->status=='active'?'selected':'' }}>Active</option>
                <option value="inactive" {{ $customer->status=='inactive'?'selected':'' }}>Inactive</option>
            </select>

            <div class="flex justify-end space-x-4 mt-4">
                <button type="button" onclick="closeModal('edit-modal-{{ $customer->id }}')" class="px-4 py-2 rounded border">Cancel</button>
                <button type="submit" class="bg-black text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
</div>
@endforeach
