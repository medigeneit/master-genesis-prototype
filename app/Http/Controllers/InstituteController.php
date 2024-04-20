<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstituteStoreRequest;
use App\Http\Requests\InstituteUpdateRequest;
use App\Models\Institute;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InstituteController extends Controller
{
    public function index(Request $request)
    {
        $institutes = Institute::all();

        return view('institute.index', compact('institutes'));
    }

    public function create(Request $request)
    {
        return view('institute.create');
    }

    public function store(InstituteStoreRequest $request)
    {
        $institute = Institute::create($request->validated());

        $request->session()->flash('institute.id', $institute->id);

        return redirect()->route('institutes.index');
    }

    public function show(Request $request, Institute $institute)
    {
        return view('institute.show', compact('institute'));
    }

    public function edit(Request $request, Institute $institute)
    {
        return view('institute.edit', compact('institute'));
    }

    public function update(InstituteUpdateRequest $request, Institute $institute)
    {
        $institute->update($request->validated());

        $request->session()->flash('institute.id', $institute->id);

        return redirect()->route('institutes.index');
    }

    public function destroy(Request $request, Institute $institute)
    {
        $institute->delete();

        return redirect()->route('institutes.index');
    }
}
