<?php

namespace App\Http\Controllers;

use App\Http\Requests\MentorStoreRequest;
use App\Http\Requests\MentorUpdateRequest;
use App\Models\Mentor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MentorController extends Controller
{
    public function index(Request $request)
    {
        $mentors = Mentor::all();

        return view('mentor.index', compact('mentors'));
    }

    public function create(Request $request)
    {
        return view('mentor.create');
    }

    public function store(MentorStoreRequest $request)
    {
        $mentor = Mentor::create($request->validated());

        $request->session()->flash('mentor.id', $mentor->id);

        return redirect()->route('mentors.index');
    }

    public function show(Request $request, Mentor $mentor)
    {
        return view('mentor.show', compact('mentor'));
    }

    public function edit(Request $request, Mentor $mentor)
    {
        return view('mentor.edit', compact('mentor'));
    }

    public function update(MentorUpdateRequest $request, Mentor $mentor)
    {
        $mentor->update($request->validated());

        $request->session()->flash('mentor.id', $mentor->id);

        return redirect()->route('mentors.index');
    }

    public function destroy(Request $request, Mentor $mentor)
    {
        $mentor->delete();

        return redirect()->route('mentors.index');
    }
}
