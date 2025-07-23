<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\Course;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class StudentController extends Controller
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
       $course = Course::all();
       $students = Student::all();
       return view('student.index',
            compact(
                'course',
                'students',
            ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $course = Course::find($request->courseId);
        $semester = $request->semester;
        $student = Student::where('currentSemester',$semester)->orderBy('id','desc')->first();
        if($student)
        {
            $classRollNo = $student->classRollNo + 1;
        }
        else
        {
            $classRollNo = 1;
        }
        return view('student.create',compact('course','classRollNo','semester'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = new Student;
        $student->courseId = $request->courseId;
        $student->academicYear = $request->academicYear;
        $student->name = $request->name;
        $student->boardRollNo = $request->boardRollNo;
        $student->classRollNo = $request->classRollNo;
        $student->contact = $request->contact;
        $student->address = $request->address;
        $student->dob = $request->dob;
        $student->bloodGroup = $request->bloodGroup;
        $student->idMark = $request->idMark;
        $student->currentSemester = $request->currentSemester;
        $student->status = $request->status;
        $student->save();

        $student = Student::where('currentSemester',$request->currentSemester)->orderBy('id','desc')->first();

        $user = new User;
        $user->name = $request->name;
        $user->email = $student->classRollNo.$student->academicYear."@champhaidiet.in";
        $user->password = hash::make("pass");
        $user->role = "Student";
        $user->save();

        $user = User::where('id','>',0)->orderBy('id','desc')->first();

        $student->userId = $user->id;
        $student->save();

        return redirect('student')->with('success','Student Details successfully Added. Usename : '.$student->classRollNo.$student->academicYear."@champhaidiet.in"." Passowrd : pass");
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
        $student = Student::find($id);
        return view('student.edit',compact('student'));
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
        $student = Student::find($id);
        $student->academicYear = $request->academicYear;
        $student->name = $request->name;
        $student->boardRollNo = $request->boardRollNo;
        $student->classRollNo = $request->classRollNo;
        $student->contact = $request->contact;
        $student->address = $request->address;
        $student->dob = $request->dob;
        $student->bloodGroup = $request->bloodGroup;
        $student->idMark = $request->idMark;
        $student->currentSemester = $request->currentSemester;
        $student->status = $request->status;
        $student->save();

        return redirect('student')->with('success','Student Details has been successfully updated');
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
    public function newStudent(Request $request)
    {
        $courses = Course::all();
        return view('student.newStudent',compact('courses'));
    }

    public function deleteStudent($id)
    {
        $attendance = Attendance::where('studentId',$id)->delete();
        $student = Student::find($id);
        $user = User::find($student->userId)->delete();
        Student::find($id)->delete();
        return back()->with('success','Student details has been deleted');
    }
    public function studentGenPass()
    {
        $students = Student::all();
        foreach($students as $student)
        {
            $user = new User;
            $user->name = $student->name;
            $user->email = $student->classRollNo.$student->academicYear."@champhaidiet.in";
            $user->password = hash::make("pass");
            $user->role = "Student";
            $user->save();
        }

    }
    public function studentGenUserId()
    {
        $users = User::where('role','Student')->get();
        foreach($users as $user)
        {
            $student = Student::where('name',$user->name)->first();
            $student->userId = $user->id;
            $student->save();

        }
    }
}
