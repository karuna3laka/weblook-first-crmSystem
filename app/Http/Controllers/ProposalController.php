<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Customer;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function index()
    {
        $proposals = Proposal::with('customer')->latest()->paginate(10);
        return view('proposals.index', compact('proposals'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('proposals.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
        ]);

        Proposal::create($request->all());

        return redirect()->route('proposals.index')->with('success', 'Proposal created successfully.');
    }

    public function edit(Proposal $proposal)
    {
        $customers = Customer::all();
        return view('proposals.edit', compact('proposal', 'customers'));
    }

    public function update(Request $request, Proposal $proposal)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'status' => 'required|in:draft,sent,accepted,declined',
        ]);

        $proposal->update($request->all());

        return redirect()->route('proposals.index')->with('success', 'Proposal updated successfully.');
    }

    public function destroy(Proposal $proposal)
    {
        $proposal->delete();
        return redirect()->route('proposals.index')->with('success', 'Proposal deleted successfully.');
    }
}
