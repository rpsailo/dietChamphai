<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Attendance;
use App\Models\Faculty;
use App\Models\Facultysubject;


class DashboardController extends Controller
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
        if(Auth::user()->role == 'Student')
        {
            $student = Student::where('userId',Auth::user()->id)->first();
            $subjects = Subject::where('semester',$student->currentSemester)
                ->where('courseId',$student->courseId)
                ->get();
            $faculties = Faculty::all();
            $facultySubjects = Facultysubject::where('semesterId',$student->currentSemester)
                ->where('courseId',$student->courseId)
                ->get();
            $attendances = Attendance::where('courseId',$student->courseId)
                ->where('semester',$student->currentSemester)
                ->where('studentId',$student->id)
                ->whereMonth('date',date('m'))
                ->whereYear('date',date('Y'))
                ->get();
            /* $attendances = Attendance::where('courseId',$subject->courseId)
            ->where('facultyId',$faculty->id)
            ->where('subjectId',$subject->id)
            ->where('semester',$student->currentSemester)
            ->whereMonth('date',date('m'))
            ->whereYear('date',date('Y'))
            ->get(); */

            return view('dashboard',
                compact(
                    'student',
                    'subjects',
                    'faculties',
                    'attendances',
                    'facultySubjects',
                    )
            );
        }
        else
        {
            $facultySubjects = null;
            $student = null;
        }
        return view('dashboard');
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
        //
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
        //
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
}
