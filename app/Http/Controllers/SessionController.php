<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionStoreRequest;
use App\Http\Requests\SessionUpdateRequest;
use App\Models\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SessionController extends Controller
{
    public function index(Request $request)
    {
        $sessions = Session::all();

        return view('session.index', compact('sessions'));
    }

    public function create(Request $request)
    {
        return view('session.create');
    }

    public function store(SessionStoreRequest $request)
    {
        $session = Session::create($request->validated());

        $request->session()->flash('session.id', $session->id);

        return redirect()->route('sessions.index');
    }

    public function show(Request $request, Session $session)
    {
        return view('session.show', compact('session'));
    }

    public function edit(Request $request, Session $session)
    {
        return view('session.edit', compact('session'));
    }

    public function update(SessionUpdateRequest $request, Session $session)
    {
        $session->update($request->validated());

        $request->session()->flash('session.id', $session->id);

        return redirect()->route('sessions.index');
    }

    public function destroy(Request $request, Session $session)
    {
        $session->delete();

        return redirect()->route('sessions.index');
    }
}
