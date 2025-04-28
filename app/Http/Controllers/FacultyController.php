<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class FacultyController extends Controller
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
        $faculties = Faculty::all();
        return view('faculty.create',compact('faculties'));
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
        $faculty = new Faculty;
        $faculty->name = $request->faculty;
        $faculty->fatherName = $request->fatherName;
        $faculty->motherName = $request->motherName;
        $faculty->contact = $request->contact;
        $faculty->permanentAddress = $request->parmanentAddress;
        $faculty->dob = $request->dob;
        $faculty->bloodGroup = $request->bloodGroup;
        $faculty->save();

        $user = new User;
        $user->name = $request->faculty;
        $user->email = $request->faculty."@gmail.com";
        $user->password = hash::make("pass");
        $user->role = "Faculty";
        $user->save();



        return back()->with('success','Faculty Details successfully Added. Usename : '.$request->faculty."@gmail.com"." Passowrd : pass");
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
