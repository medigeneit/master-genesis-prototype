<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentStoreRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::all();

        return view('department.index', compact('departments'));
    }

    public function create(Request $request)
    {
        return view('department.create');
    }

    public function store(DepartmentStoreRequest $request)
    {
        $department = Department::create($request->validated());

        $request->session()->flash('department.id', $department->id);

        return redirect()->route('departments.index');
    }

    public function show(Request $request, Department $department)
    {
        return view('department.show', compact('department'));
    }

    public function edit(Request $request, Department $department)
    {
        return view('department.edit', compact('department'));
    }

    public function update(DepartmentUpdateRequest $request, Department $department)
    {
        $department->update($request->validated());

        $request->session()->flash('department.id', $department->id);

        return redirect()->route('departments.index');
    }

    public function destroy(Request $request, Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index');
    }
}
