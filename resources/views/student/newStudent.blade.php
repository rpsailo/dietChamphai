@extends('adminlte::page')

@section('title', 'Select Course and Semester for New Student')

@section('content_header')
    <h1>Select Course and Semester for New Student</h1>
@stop

@section('content')
    <p>Select required information</p>
    @include('layout.alert')
    <div class="row">
        <div class="col-md-9">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        Select Course and Semester
                    </h3>
                </div>

                <div class="card-body">
                    <form method="GET" action=" {{ route('student.create') }} ">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Course">Course Name</label>
                                <select name="courseId" id="" class="form-control" required>
                                    <option value="" selected>Select Course</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <select name="semester" class="form-control" required>
                                    <option value="" selected>Select Semester</option>
                                    <option value="1">I Semester</option>
                                    <option value="2">II Semester</option>
                                    <option value="3">III Semester</option>
                                    <option value="4">IV Semester</option>
                                    <option value="5">V Semester</option>
                                    <option value="6">VI Semester</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type='submit' class='btn btn-success'><i class='fa fa-check-square'></i> Go to Create Student</button>
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
