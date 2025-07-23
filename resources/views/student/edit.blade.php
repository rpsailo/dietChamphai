@extends('adminlte::page')

@section('title', 'Edit Student')

@section('content_header')
    <h1>Edit Student</h1>
@stop

@section('content')
    <p>Edit Student</p>
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
                    <form method="POST" action=" {{ route('student.update',$student->id) }} ">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="academicYear">Academic Year</label>
                                <input type="text" class="form-control" name="academicYear" value="{{ $student->academicYear }}" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="name">Student Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $student->name }}" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="classRollNo">class Roll No</label>
                                <input type="text" class="form-control" name="classRollNo" value="{{ $student->classRollNo }}" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="boardRollNo">Board Roll No</label>
                                <input type="text" class="form-control" name="boardRollNo" value="{{ $student->boardRollNo }}" autocomplete='off' autofocus='on' >
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" class="form-control" name="contact" value="{{ $student->contact }}" autocomplete='off' autofocus='on' >
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" value="{{ $student->address }}" autocomplete='off' autofocus='on'>
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control" name="dob" value="{{ $student->dob }}" autocomplete='off' autofocus='on'>
                            </div>
                            <div class="form-group">
                                <label for="bloodGroup">Blood Group</label>
                                <input type="text" class="form-control" name="bloodGroup" value="{{ $student->bloodGroup }}" autocomplete='off' autofocus='on'>
                            </div>
                            <div class="form-group">
                                <label for="idMark">ID Mark</label>
                                <input type="text" class="form-control" name="idMark" value="{{ $student->idMark }}" autocomplete='off' autofocus='on'>
                            </div>
                            <div class="form-group">
                                <label for="currentSemester">Current Semester</label>
                                <select name="currentSemester" class="form-control" required>
                                    <option value="{{ $student->currentSemester }}" selected>{{ $student->currentSemester }} Semester</option>
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
                                    <option value="{{ $student->status }}">@php if($student->status == 0) echo "In-Active"; elseif($student->status == 1) echo "Active"; else echo "Discontinue"; @endphp</option>
                                    <option value="0">In-Active</option>
                                    <option value="1">Active</option>
                                    <option value="2">Discontinue</option>
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
