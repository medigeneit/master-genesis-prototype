<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModuleStoreRequest;
use App\Http\Requests\ModuleUpdateRequest;
use App\Models\LectureVideo;
use App\Models\Module;
use App\Models\Topic;
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

        // return 
        $module_contents = $module->topics_by_contents()->distinct('id')->select('*')->with(
            'exams.material',
            'solve_classes.material',
            'lectures.material',
            'feedback_classes.material',
        )->get();

        // $module_topics = $module->topics()->get();
        $module_content_columns = $this->module_content_columns( $module );

        return view('module.show', compact('module', 'module_contents', 'module_content_columns'));
    }

    private function module_content_columns( Module $module ){

        $content_materials = function($string, $content){
            return $string .= '<div class="border-b py-1">'. ($content->material->name ?? ''). '</div>';
        };

        return [
            [
                'valueKey' => 'id', 
                'label' => 'ID' 
            ],
            [
                'valueKey' => function(Topic $topic){
                    return $topic->name;
                },
                'label' => 'Topic'
            ],

            [
                'valueKey' => function(Topic $topic) use($content_materials){
                    return $topic->exams->reduce( $content_materials, '' );
                },
                'label' => 'Exams'
            ],
            [
                'valueKey' => function(Topic $topic) use($content_materials){
                    return $topic->solve_classes->reduce( $content_materials, '' );
                },
                'label' => 'Solves'
            ],
            [
                'valueKey' => function(Topic $topic) use($content_materials){
                    return $topic->lectures->reduce( $content_materials, '' );
                },
                'label' => 'Lectures'
            ],
            [
                'valueKey' => function(Topic $topic) use($content_materials){
                    return $topic->feedback_classes->reduce( $content_materials, '' );
                },
                'label' => 'Feedbacks'
            ],
        
        ];
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
