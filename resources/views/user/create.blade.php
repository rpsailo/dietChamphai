@extends('adminlte::page')

@section('title', 'New Users')

@section('content_header')
    <h1>User</h1>
@stop

@section('content')
    <p>Create New User</p>
    @include('layout.alert')
    <div class="row">
        <div class="col-md-5">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        User
                    </h3>
                </div>

                <div class="card-body">
                    <form method="POST" action=" {{ route('user.store') }} ">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="username">UserName</label>
                                <input type="text" class="form-control" name="username" placeholder="Enter User Name" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="email">email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter Email" autocomplete='off'  required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control"  name="password" placeholder="Enter Password" autocomplete='off'  required>
                            </div>
                            <div class="form-group">
                                <label for="confrimpassword">Confirm Password</label>
                                <input type="password" class="form-control"  name="confirmpassword" placeholder="Enter Confirm Password" autocomplete='off' required>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="" selected>Select Role</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Principal">Principal</option>
                                    <option value="Faculty">Faculty</option>
                                    <option value="Staff">Staff</option>
                                    <option value="Student">Student</option>
                                </select>
                             </div>
                            <div class="form-group">
                                <button type='submit' class='btn btn-success'><i class='fa fa-save'></i> Save</button>
                            </div>
                        </div>

                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        Existing Users
                    </h3>
                </div>

                <div class="card-body">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>UserName</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key=>$user)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <button type='button' class="btn btn-danger btn-sm" onclick="location.href='/deleteUser/{{ $user->id }}'">Delete</button>
                                    <button type='button' class="btn btn-primary btn-sm" onclick="location.href='/editUser/{{ $user->id }}'">Edit</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<link href="/vendor/datatables/css/datatables.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="/vendor/datatables/js/datatables.min.js"></script>
    <script> console.log("DIET, CHAMPHAI"); </script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>

@stop
