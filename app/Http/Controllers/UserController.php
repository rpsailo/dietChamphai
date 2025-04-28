<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
        $users = User::all();
        return view('user.create',compact('users'));
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
        $user = new User();
        if ($request->password == $request->confirmpassword)
        {
            $user->name = $request->username;
            $user->email = $request->email;
            $user->password = hash::make($request->password);
            $user->role = $request->role;
            $user->save();
            return back()->with('success', 'User successfully created');

        }
        else
        {
            return back()->with('danger', 'Passwords do not match');
        }
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
        $user = User::find($id);
        if($request->password)
        {
            if ($request->password == $request->confirmpassword)
                {
                    if($request->has('cp'))
                    {
                        $user->name = $request->username;
                        $user->email = $request->email;
                        $user->password = hash::make($request->password);
                        $user->save();
                        return back()->with('success', 'User successfully created');
                    }
                    else
                    {
                        $user->name = $request->username;
                        $user->email = $request->email;
                        $user->password = hash::make($request->password);
                        $user->role = $request->role;
                        $user->save();
                        return redirect('/user')->with('success', 'User successfully created');
                    }



                }
                else
                {
                    return back()->with('danger', 'Passwords do not match');
                }
        }
        else
        {
            $user->name = $request->username;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->save();
            return redirect('/user')->with('success', 'User successfully updated');

        }
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

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with('success', 'User successfully deleted');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $users = User::all();
        return view('user.edit', compact('user','users'));
    }
}
