<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModuleTopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Module $module)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Module $module)
    {

        // return 
        $topics = Topic::query()->whereNotIn( 'id', $module->topics()->select('id'))->get();

        //
        return  view( 'module-topics.create', compact( 'module', 'topics') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Module $module)
    {

        $data = $request->validate([
            'topic_ids' => 'required|array',
            'topic_ids.*' => 'exists:topics,id'
        ]);

        $module->topics()->attach(
            $data['topic_ids'] 
        );

        return redirect()->route('modules.show', [$module->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module, Topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module, Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module, Topic $topic)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module, Topic $topic)
    {
 
        DB::table('module_topic')
            ->where(['module_id' => $module->id, 'topic_id' => $topic->id])
            ->delete();

        return redirect()->route('modules.show', [$module->id]);
    }
}
