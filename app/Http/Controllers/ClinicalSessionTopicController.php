<?php

namespace App\Http\Controllers;

use App\Models\ClinicalSessionTopic;
use Illuminate\Http\Request;

class ClinicalSessionTopicController extends Controller
{
    public function index(Request $request)
    {
        $clinical_session_topics = ClinicalSessionTopic::all();

        return view('clinical-session-topic.index', compact('clinical_session_topics'));
    }

    public function create(Request $request)
    {
        return view('clinical-session-topic.create');
    }

    public function store(Request $request)
    {
        $clinical_session_topic = ClinicalSessionTopic::create($request->validated());

        $request->session()->flash('clinical_session_topic.id', $clinical_session_topic->id);

        return redirect()->route('clinical_session_topics.index');
    }

    public function show(Request $request, ClinicalSessionTopic $clinical_session_topic)
    {
        return view('clinical-session-topic.show', compact('clinical_session_topic'));
    }

    public function edit(Request $request, ClinicalSessionTopic $clinical_session_topic)
    {
        return view('clinical-session-topic.edit', compact('clinical_session_topic'));
    }

    public function update(Request $request, ClinicalSessionTopic $clinical_session_topic)
    {
        $clinical_session_topic->update($request->validated());

        $request->session()->flash('clinical_session_topic.id', $clinical_session_topic->id);

        return redirect()->route('clinical_session_topics.index');
    }

    public function destroy(Request $request, ClinicalSessionTopic $clinical_session_topic)
    {
        $clinical_session_topic->delete();

        return redirect()->route('clinical_session_topics.index');
    }
}
