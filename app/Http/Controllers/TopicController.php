<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicStoreRequest;
use App\Http\Requests\TopicUpdateRequest;
use App\Models\Topic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TopicController extends Controller
{
    public function index(Request $request)
    {
        $topics = Topic::all();

        return view('topic.index', compact('topics'));
    }

    public function create(Request $request)
    {
        return view('topic.create');
    }

    public function store(TopicStoreRequest $request)
    {
        $topic = Topic::create($request->validated());

        $request->session()->flash('topic.id', $topic->id);

        return redirect()->route('topics.index');
    }

    public function show(Request $request, Topic $topic)
    {
        return view('topic.show', compact('topic'));
    }

    public function edit(Request $request, Topic $topic)
    {
        return view('topic.edit', compact('topic'));
    }

    public function update(TopicUpdateRequest $request, Topic $topic)
    {
        $topic->update($request->validated());

        $request->session()->flash('topic.id', $topic->id);

        return redirect()->route('topics.index');
    }

    public function destroy(Request $request, Topic $topic)
    {
        $topic->delete();

        return redirect()->route('topics.index');
    }
}
