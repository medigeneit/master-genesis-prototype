<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContentStoreRequest;
use App\Http\Requests\ContentUpdateRequest;
use App\Models\Content;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        $contents = Content::all();

        return view('content.index', compact('contents'));
    }

    public function create(Request $request)
    {
        return view('content.create');
    }

    public function store(ContentStoreRequest $request)
    {
        $content = Content::create($request->validated());

        $request->session()->flash('content.id', $content->id);

        return redirect()->route('contents.index');
    }

    public function show(Request $request, Content $content)
    {
        return view('content.show', compact('content'));
    }

    public function edit(Request $request, Content $content)
    {
        return view('content.edit', compact('content'));
    }

    public function update(ContentUpdateRequest $request, Content $content)
    {
        $content->update($request->validated());

        $request->session()->flash('content.id', $content->id);

        return redirect()->route('contents.index');
    }

    public function destroy(Request $request, Content $content)
    {
        $content->delete();

        return redirect()->route('contents.index');
    }
}
