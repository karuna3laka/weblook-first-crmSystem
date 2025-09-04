@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white rounded-xl shadow p-20 sm:p-6 lg:p-8">

    <h1 class="text-2xl font-bold mb-6 text-gray-900">Proposals</h1>

    <!-- Add Proposal Button -->
    <a href="{{ route('proposals.create') }}"
       class="bg-black text-white px-4 py-2 rounded mb-4 inline-block hover:bg-gray-800">
        + New Proposal
    </a>

    <!-- Success message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Proposals Table -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-200 min-w-[800px]">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Customer</th>
                    <th class="border px-4 py-2">Title</th>
                    <th class="border px-4 py-2">Amount</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($proposals as $proposal)
                    <tr>
                        <td class="border px-4 py-2 font-mono text-sm">{{ $proposal->id }}</td>
                        <td class="border px-4 py-2 truncate max-w-[160px]">
                            {{ $proposal->customer?->name ?? 'Customer Null' }}
                        </td>
                        <td class="border px-4 py-2 truncate max-w-[200px]">{{ $proposal->title }}</td>
                        <td class="border px-4 py-2 whitespace-nowrap">${{ number_format($proposal->amount, 2) }}</td>
                        <td class="border px-4 py-2">
                            <span class="px-2 py-1 text-xs rounded 
                                {{ $proposal->status === 'approved' ? 'bg-green-200 text-green-800' : 
                                   ($proposal->status === 'pending' ? 'bg-yellow-200 text-yellow-800' : 
                                   'bg-red-200 text-red-800') }}">
                                {{ ucfirst($proposal->status) }}
                            </span>
                        </td>
                        <td class="border px-4 py-2 flex flex-wrap gap-2">
                            <!-- Edit -->
                            <a href="{{ route('proposals.edit', $proposal) }}"
                               class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                Edit
                            </a>
                            <!-- Delete -->
                            <form action="{{ route('proposals.destroy', $proposal) }}" method="POST"
                                  onsubmit="return confirm('Delete this proposal?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border px-4 py-6 text-center text-gray-500">
                            No proposals found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
