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
        if(!$faculty)
        {
            return back()->with('danger','Only Faculty can update attendance, Please login in Faculty Account');
        }
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
            else
            {
                $attendance = new Attendance;
                $attendance->courseId = $subject->courseId;
                $attendance->facultyId = $faculty->id;
                $attendance->subjectId = $subject->id;
                $attendance->studentId = $student->id;
                $attendance->semester = $subject->semester;
                $attendance->date = date('Y-m-d');
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
        //dd(date('Y-m-d'));
        $subject = Subject::find($id);
        $faculty = Faculty::where('userId',Auth::user()->id)->first();
        $attendance = Attendance::where('courseId',$subject->courseId)
            ->where('facultyId',$faculty->id)
            ->where('subjectId',$subject->id)
            ->where('semester',$subject->semester)
            ->where('date','2025-07-19')
            ->get();
        $students = Student::where('courseId',$subject->courseId)
            ->where('currentSemester',$subject->semester)
            ->get();
        if($attendance->count())
        {
            return view('attendance.updateAttendance',compact(
                    'subject',
                    'students',
                    'faculty',
                    'attendance',
                ));
        }
        else
        {
            return view('attendance.markAttendance',compact(
                    'subject',
                    'faculty',
                    'students',
                ));
        }

    }

    public function updateAttendance(Request $request)
    {
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
                $attendance = Attendance::where('courseId',$subject->courseId)
                    ->where('facultyId',$faculty->id)
                    ->where('subjectId',$subject->id)
                    ->where('studentId',$student->id)
                    ->where('semester',$subject->semester)
                    ->where('date',date('Y-m-d'))
                    ->first();
                if($attendance)
                {
                    $attendance->mark = 1;
                    $attendance->leave = null;
                    $attendance->save();
                }
                else
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

            }
            elseif($request->$leave)
            {
                $attendance = Attendance::where('courseId',$subject->courseId)
                    ->where('facultyId',$faculty->id)
                    ->where('subjectId',$subject->id)
                    ->where('studentId',$student->id)
                    ->where('semester',$subject->semester)
                    ->where('date',date('Y-m-d'))
                    ->first();
                if($attendance)
                {
                    $attendance->mark = null;
                    $attendance->leave = 1;
                    $attendance->save();
                }
                else
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
            else
            {
                $attendance = Attendance::where('courseId',$subject->courseId)
                    ->where('facultyId',$faculty->id)
                    ->where('subjectId',$subject->id)
                    ->where('studentId',$student->id)
                    ->where('semester',$subject->semester)
                    ->where('date',date('Y-m-d'))
                    ->first();
                if($attendance)
                {
                    $attendance->mark = null;
                    $attendance->leave = null;
                    $attendance->save();
                }
                else
                {
                    $attendance = new Attendance;
                    $attendance->courseId = $subject->courseId;
                    $attendance->facultyId = $faculty->id;
                    $attendance->subjectId = $subject->id;
                    $attendance->studentId = $student->id;
                    $attendance->semester = $subject->semester;
                    $attendance->mark = null;
                    $attendance->leave = null;
                    $attendance->date = date('Y-m-d');
                    $attendance->save();
                }
            }
        }
        return redirect('/attendance')->with('success','Attendance successfully Updated');
    }
    public function editAttendance(Request $request)
    {
        //dd($request->all());
        $subject = Subject::find($request->subjectId);
        $faculty = Faculty::where('userId',Auth::user()->id)->first();
        $timestamp = strtotime($request->date);
        $date = date('d-m-Y', $timestamp);
        $attendance = Attendance::where('courseId',$subject->courseId)
            ->where('facultyId',$faculty->id)
            ->where('subjectId',$subject->id)
            ->where('semester',$subject->semester)
            ->where('date',$request->date)
            ->get();
        $students = Student::where('courseId',$subject->courseId)
            ->where('currentSemester',$subject->semester)
            ->get();
        if($attendance->count())
        {
            return view('attendance.editAttendance',compact(
                    'subject',
                    'students',
                    'date',
                    'faculty',
                    'attendance',
                ));
        }
        else
        {
           return back()->with('danger','Attendance not available on this Date');
        }


    }

    public function updateEditAttendance(Request $request)
    {
        $faculty = Faculty::where('userId',Auth::user()->id)->first();
        $subject = Subject::find($request->subjectId);
        $date = date_create($request->date);
        $date = date_format($date,'Y-m-d');
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
                $attendance = Attendance::where('courseId',$subject->courseId)
                    ->where('facultyId',$faculty->id)
                    ->where('subjectId',$subject->id)
                    ->where('studentId',$student->id)
                    ->where('semester',$subject->semester)
                    ->where('date',$date)
                    ->first();
                if($attendance)
                {
                    $attendance->mark = 1;
                    $attendance->leave = null;
                    $attendance->save();
                }

            }
            elseif($request->$leave)
            {
                $attendance = Attendance::where('courseId',$subject->courseId)
                    ->where('facultyId',$faculty->id)
                    ->where('subjectId',$subject->id)
                    ->where('studentId',$student->id)
                    ->where('semester',$subject->semester)
                    ->where('date',$date)
                    ->first();
                if($attendance)
                {
                    $attendance->mark = null;
                    $attendance->leave = 1;
                    $attendance->save();
                }
            }

        }
        return redirect('/attendance')->with('success','Attendance successfully Updated');
    }

    public function viewAttendance(Request $request)
    {
        $subject = Subject::find($request->subjectId);
        $faculty = Faculty::where('userId',Auth::user()->id)->first();
        $attendance = Attendance::where('courseId',$subject->courseId)
        ->where('facultyId',$faculty->id)
        ->where('subjectId',$subject->id)
        ->where('semester',$subject->semester)
        ->whereMonth('date',date('m'))
        ->whereYear('date',date('Y'))
        ->get();
        //dd($attendance);
        $students = Student::where('courseId',$subject->courseId)
            ->where('currentSemester',$subject->semester)
            ->get();
        if($attendance->count())
        {
            return view('attendance.viewAttendance',compact(
                    'subject',
                    'students',
                    'faculty',
                    'attendance',
                ));
        }
        else
        {
           return back()->with('warning','No Attendance on the current month');
        }
    }
}
