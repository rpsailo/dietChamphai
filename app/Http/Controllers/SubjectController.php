<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Course;


class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $courses = Course::all();
        $subjects = Subject::all();
        return view('subject.create',
            compact(
                'subjects',
                'courses',
            ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subject = new Subject;
        $subject->courseId = $request->courseId;
        $subject->name = $request->name;
        $subject->semester = $request->semester;
        $subject->save();

        return back()->with('success','New Subject Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subject = Subject::find($id);
        $subject->courseId = $request->courseId;
        $subject->name = $request->name;
        $subject->semester = $request->semester;
        $subject->save();

        return back()->with('success','Subject has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function deleteSubject($id)
    {
        $subject = Subject::find($id);
        $subject->delete();
        return back()->with('success', 'Subject successfully deleted');
    }

    public function editSubject($id)
    {
        $subject = Subject::find($id);
        $courses = Course::all();
        $course = Course::find($subject->courseId);
        $subjects = Subject::all();
        return view('subject.edit',
                compact(
                    'subject',
                    'subjects',
                    'course',
                    'courses',
                ));
    }
}
