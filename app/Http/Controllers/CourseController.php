<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::all();

        return view('course.index', compact('courses'));
    }

    public function create(Request $request)
    {
        return view('course.create');
    }

    public function store(CourseStoreRequest $request)
    {
        $course = Course::create($request->validated());

        $request->session()->flash('course.id', $course->id);

        return redirect()->route('courses.index');
    }

    public function show(Request $request, Course $course)
    {
        return view('course.show', compact('course'));
    }

    public function edit(Request $request, Course $course)
    {
        return view('course.edit', compact('course'));
    }

    public function update(CourseUpdateRequest $request, Course $course)
    {
        $course->update($request->validated());

        $request->session()->flash('course.id', $course->id);

        return redirect()->route('courses.index');
    }

    public function destroy(Request $request, Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index');
    }
}
