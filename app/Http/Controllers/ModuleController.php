<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModuleStoreRequest;
use App\Http\Requests\ModuleUpdateRequest;
use App\Models\Module;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ModuleController extends Controller
{
    public function index(Request $request)
    {
        $modules = Module::all();

        return view('module.index', compact('modules'));
    }

    public function create(Request $request)
    {
        return view('module.create');
    }

    public function store(ModuleStoreRequest $request)
    {
        $module = Module::create($request->validated());

        $request->session()->flash('module.id', $module->id);

        return redirect()->route('modules.index');
    }

    public function show(Request $request, Module $module)
    {
        return view('module.show', compact('module'));
    }

    public function edit(Request $request, Module $module)
    {
        return view('module.edit', compact('module'));
    }

    public function update(ModuleUpdateRequest $request, Module $module)
    {
        $module->update($request->validated());

        $request->session()->flash('module.id', $module->id);

        return redirect()->route('modules.index');
    }

    public function destroy(Request $request, Module $module)
    {
        $module->delete();

        return redirect()->route('modules.index');
    }
}
