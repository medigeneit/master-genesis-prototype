<?php

namespace App\Http\Controllers;

use App\Http\Requests\BatchStoreRequest;
use App\Http\Requests\BatchUpdateRequest;
use App\Models\Batch;
use App\Models\FacultyDiscipline;
use App\Models\Module;
use App\Models\Session;
use App\Models\Topic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BatchController extends Controller
{
    public function index(Request $request)
    {
        $batches = Batch::all();

        return view('batch.index', compact('batches'));
    }

    function data(Batch $batch){

        $sessions = Session::get( );
        $modules = Module::get( );
        $topics = Topic::query( )->get( );
        $faculty_disciplines = FacultyDiscipline::get();

        return compact( 'sessions', 'topics', 'faculty_disciplines','batch','modules' );
    }

    public function create(Request $request)
    {
        return view('batch.create', $this->data(new Batch()));
    }

    public function store(BatchStoreRequest $request)
    {
        $batch = Batch::create($request->validated());

        $request->session()->flash('batch.id', $batch->id);

        return redirect()->route('batches.index');
    }

    public function show(Request $request, Batch $batch)
    {
        return view('batch.show', compact('batch'));
    }

    public function edit(Request $request, Batch $batch)
    {
        return view('batch.edit', $this->data($batch));
    }

    public function update(BatchUpdateRequest $request, Batch $batch)
    {
        $batch->update($request->validated());

        $request->session()->flash('batch.id', $batch->id);

        return redirect()->route('batches.index');
    }

    public function destroy(Request $request, Batch $batch)
    {
        $batch->delete();

        return redirect()->route('batches.index');
    }
}
