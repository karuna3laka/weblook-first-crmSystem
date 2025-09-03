@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white rounded-xl shadow p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-900">Proposals</h1>

    <a href="{{ route('proposals.create') }}" class="bg-black text-white px-4 py-2 rounded mb-4 inline-block hover:bg-gray-800">
        + New Proposal
    </a>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full text-left border">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Customer</th>
                <th class="px-4 py-2">Title</th>
                <th class="px-4 py-2">Amount</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proposals as $proposal)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $proposal->id }}</td>
                    <td class="px-4 py-2">{{ $proposal->customer->name }}</td>
                    <td class="px-4 py-2">{{ $proposal->title }}</td>
                    <td class="px-4 py-2">${{ $proposal->amount }}</td>
                    <td class="px-4 py-2">{{ ucfirst($proposal->status) }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('proposals.edit', $proposal) }}" class="bg-blue-500 text-white px-3 py-1 rounded">Edit</a>
                        <form action="{{ route('proposals.destroy', $proposal) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
