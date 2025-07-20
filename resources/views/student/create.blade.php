@extends('adminlte::page')

@section('title', 'Create New Student')

@section('content_header')
    <h1>Student</h1>
@stop

@section('content')
    <p>Create New Student</p>
    @include('layout.alert')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        Student Information
                    </h3>
                </div>

                <div class="card-body">
                    <form method="POST" action=" {{ route('student.store') }} ">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="course">Course Name</label>
                                <select name="courseId" id="" class="form-control" required>
                                    <option value="">Select Course</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="academicYear">Academic Year</label>
                                <input type="text" class="form-control" name="academicYear" placeholder="Enter Academic Year" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="name">Student Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Student Name" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="classRollNo">class Roll No</label>
                                <input type="text" class="form-control" name="classRollNo" placeholder="Enter Class Roll No" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="boardRollNo">Board Roll No</label>
                                <input type="text" class="form-control" name="boardRollNo" placeholder="Enter Board Roll No" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" class="form-control" name="contact" placeholder="Enter Contact" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" placeholder="Enter Address" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control" name="dob" placeholder="Enter Date of Birth" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="bloodGroup">Blood Group</label>
                                <input type="text" class="form-control" name="bloodGroup" placeholder="Enter Blood Group" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="idMark">ID Mark</label>
                                <input type="text" class="form-control" name="idMark" placeholder="Enter ID Mark" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="currentSemester">Current Semester</label>
                                <input type="text" class="form-control" name="currentSemester" placeholder="Enter Current Semester" autocomplete='off' autofocus='on' required>
                                <select name="currentSemester" class="form-control" required>
                                    <option value="" selected>Select Semester</option>
                                    <option value="1">1 Semester</option>
                                    <option value="2">2 Semester</option>
                                    <option value="3">3 Semester</option>
                                    <option value="4">4 Semester</option>
                                    <option value="5">5 Semester</option>
                                    <option value="6">6 Semester</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Student Status</label>
                                <select name="status" id="" class="form-control" required>
                                    <option value="">Select Status</option>
                                    <option value="0">In-Active</option>
                                    <option value="1">Active</option>
                                    <option value="2">Discontinue</option>
                                    <option value="3">Passed Out</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type='submit' class='btn btn-success'><i class='fa fa-save'></i> Save</button>
                            </div>
                        </div>
                    </form>
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
