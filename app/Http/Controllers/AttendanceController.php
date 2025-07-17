<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\Facultysubject;

use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
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
        $faculty = Faculty::where('userId',Auth::user()->id)->first();
        $subjects = Subject::all();
        $facultySubjects = Facultysubject::where('facultyId',$faculty->id)
            ->orderBy('semesterId','asc')
            ->get();

        return view('attendance.index',compact(
            'faculty',
            'subjects',
            'facultySubjects',
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
        //dd($request->all());
        $faculty = Faculty::where('userId',Auth::user()->id)->first();
        $subject = Subject::find($request->subjectId);
        $students = Student::where('courseId',$subject->courseId)
            ->where('currentSemester',$subject->semester)
            ->orderBy('id','asc')
            ->get();
        foreach($students as $student )
        {
            $mark = "attendance".$student->id;
            $leave = "leave".$student->id;
            if($request->$mark)
            {
                $attendance = new Attendance;
                $attendance->courseId = $subject->courseId;
                $attendance->facultyId = $faculty->id;
                $attendance->subjectId = $subject->id;
                $attendance->studentId = $student->id;
                $attendance->semester = $subject->semester;
                $attendance->date = date('Y-m-d');
                $attendance->mark = 1;
                $attendance->save();
            }
            elseif($request->$leave)
            {
                $attendance = new Attendance;
                $attendance->courseId = $subject->courseId;
                $attendance->facultyId = $faculty->id;
                $attendance->subjectId = $subject->id;
                $attendance->studentId = $student->id;
                $attendance->semester = $subject->semester;
                $attendance->date = date('Y-m-d');
                $attendance->leave = 1;
                $attendance->save();
            }
        }
        return redirect('/attendance')->with('success','Attendance successfully Updated');
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

    public function markAttendance($id)
    {
        $subject = Subject::find($id);
        $students = Student::where('courseId',$subject->courseId)
            ->where('currentSemester',$subject->semester)
            ->get();
        return view('attendance.markAttendance',compact(
            'subject',
            'students',
        ));
    }
}
