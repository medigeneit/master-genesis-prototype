<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchStoreRequest;
use App\Http\Requests\BranchUpdateRequest;
use App\Models\Branch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        $branches = Branch::all();

        return view('branch.index', compact('branches'));
    }

    public function create(Request $request)
    {
        return view('branch.create');
    }

    public function store(BranchStoreRequest $request)
    {
        $branch = Branch::create($request->validated());

        $request->session()->flash('branch.id', $branch->id);

        return redirect()->route('branches.index');
    }

    public function show(Request $request, Branch $branch)
    {
        return view('branch.show', compact('branch'));
    }

    public function edit(Request $request, Branch $branch)
    {
        return view('branch.edit', compact('branch'));
    }

    public function update(BranchUpdateRequest $request, Branch $branch)
    {
        $branch->update($request->validated());

        $request->session()->flash('branch.id', $branch->id);

        return redirect()->route('branches.index');
    }

    public function destroy(Request $request, Branch $branch)
    {
        $branch->delete();

        return redirect()->route('branches.index');
    }
}
