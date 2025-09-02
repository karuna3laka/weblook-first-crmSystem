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
