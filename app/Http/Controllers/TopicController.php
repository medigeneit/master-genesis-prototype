<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicStoreRequest;
use App\Http\Requests\TopicUpdateRequest;
use App\Models\Batch;
use App\Models\Module;
use App\Models\Topic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TopicController extends Controller
{
    public function index(Request $request)
    {
        $topics = Topic::query();
        DB::disableQueryLog();
        DB::enableQueryLog();

        
        $topics->when( $request->batch_id, function( $topics, $batch_id ){
            $module_id_where = Batch::where('id',$batch_id)->select('module_id');
            $topics->whereHas('modules', function( $module ) use( $module_id_where ){
                $module->where('id', $module_id_where);
            });
        });


        // return 
        $topics = $topics->get();


        if( $request->wantsJson()) {
            return response([
                'topics' => $topics,
                'query' => DB::getQueryLog()
            ]);
        }

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
