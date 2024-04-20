<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacultyDisciplineStoreRequest;
use App\Http\Requests\FacultyDisciplineUpdateRequest;
use App\Models\FacultyDiscipline;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FacultyDisciplineController extends Controller
{
    public function index(Request $request)
    {
        $facultyDisciplines = FacultyDiscipline::all();

        return view('facultyDiscipline.index', compact('facultyDisciplines'));
    }

    public function create(Request $request)
    {
        return view('facultyDiscipline.create');
    }

    public function store(FacultyDisciplineStoreRequest $request)
    {
        $facultyDiscipline = FacultyDiscipline::create($request->validated());

        $request->session()->flash('facultyDiscipline.id', $facultyDiscipline->id);

        return redirect()->route('facultyDisciplines.index');
    }

    public function show(Request $request, FacultyDiscipline $facultyDiscipline)
    {
        return view('facultyDiscipline.show', compact('facultyDiscipline'));
    }

    public function edit(Request $request, FacultyDiscipline $facultyDiscipline)
    {
        return view('facultyDiscipline.edit', compact('facultyDiscipline'));
    }

    public function update(FacultyDisciplineUpdateRequest $request, FacultyDiscipline $facultyDiscipline)
    {
        $facultyDiscipline->update($request->validated());

        $request->session()->flash('facultyDiscipline.id', $facultyDiscipline->id);

        return redirect()->route('facultyDisciplines.index');
    }

    public function destroy(Request $request, FacultyDiscipline $facultyDiscipline)
    {
        $facultyDiscipline->delete();

        return redirect()->route('facultyDisciplines.index');
    }
}
