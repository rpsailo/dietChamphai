<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facultysubject;
use App\Models\Subject;
use App\Models\Faculty;
use App\Models\Course;

class facultySubjectController extends Controller
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
        return view('facultySubject.index',
            compact(
                'courses',
            )

        );

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
        //dd($request->all());
        $faculty = Faculty::find($request->faculty);
        $subject = Subject::find($request->subject);
        $facultySubject = new Facultysubject;
        $facultySubject->facultyId = $request->faculty;
        $facultySubject->facultyName = $faculty->name;
        $facultySubject->subjectId = $request->subject;
        $facultySubject->subjectName = $subject->name;
        $facultySubject->courseId = $request->courseId;
        $facultySubject->semesterId = $request->semester;
        $facultySubject->save();

        return back()->with('success', 'Faculty Subject Mapping successfully created');
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
        $faculty = Faculty::find($request->faculty);
        $subject = Subject::find($request->subject);
        $facultySubject = Facultysubject::find($id);
        $facultySubject->facultyId = $request->faculty;
        $facultySubject->facultyName = $faculty->name;
        $facultySubject->subjectId = $request->subject;
        $facultySubject->subjectName = $subject->name;
        $facultySubject->courseId = $request->courseId;
        $facultySubject->semesterId = $request->semester;
        $facultySubject->save();

        return back()->with('success', 'Faculty Subject Mapping successfully Updated');
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

    public function selectSemesterCourse(Request $request)
    {
        $faculties = Faculty::all();
        $subjects = Subject::where('courseId',$request->course)
            ->where('semester',$request->semester)
            ->get();

        $courseId = $request->course;
        $semester = $request->semester;
        //dd($semester);
        $course = Course::find($courseId);
        $facultySubjects = Facultysubject::where('courseId',$courseId)
            ->where('semesterId',$semester)
            ->orderBy('facultyId','asc')
            ->get();

        return view('facultySubject.create',
            compact(
                'faculties',
                'subjects',
                'course',
                'courseId',
                'semester',
                'facultySubjects',
            )

        );

    }

    public function editFacultySubject($id)
    {
        $facultySubject = Facultysubject::find($id);
        $faculties = Faculty::all();
        $subjects = Subject::where('semester',$facultySubject->semesterId)->get();

        $courseId = $facultySubject->courseId;
        $semester = $facultySubject->semesterId;
        //dd($semester);
        $course = Course::find($courseId);
        $facultySubjects = Facultysubject::where('courseId',$courseId)
            ->where('semesterId',$semester)
            ->orderBy('facultyId','asc')
            ->get();

        return view('facultySubject.edit',
            compact(
                'faculties',
                'subjects',
                'course',
                'courseId',
                'semester',
                'facultySubject',
                'facultySubjects',
            )

        );
    }
}
