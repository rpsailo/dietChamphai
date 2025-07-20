@extends('adminlte::page')

@section('title', 'Edit Course')

@section('content_header')
    <h1>Course</h1>
@stop

@section('content')
    <p>Edit Course</p>
    @include('layout.alert')
    <div class="row">
        <div class="col-md-5">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        Course
                    </h3>
                </div>

                <div class="card-body">
                    <form method="POST" action=" {{ route('course.update', $course->id) }} ">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="course">Course Name</label>
                                <input type="text" class="form-control" name="course" value="{{ $course->name }}" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="short">Short Form</label>
                                <input type="text" class="form-control" name="short" value="{{ $course->short }}" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <input type="text" class="form-control" name="semester" value="{{ $course->semester }}" autocomplete='off' autofocus='on' required>
                            </div>

                            <div class="form-group">
                                <button type='submit' class='btn btn-success'><i class='fa fa-save'></i> Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        Existing Courses
                    </h3>
                </div>

                <div class="card-body">
                    <table id="myTable" class="table table-hover text-wrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Course Name</th>
                                <th>Short</th>
                                <th>Semester</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $key=>$course)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->short }}</td>
                                <td>{{ $course->semester }}</td>
                                <td>
                                    <button type='button' class="btn btn-danger btn-sm" onclick="location.href='/deleteCourse/{{ $course->id }}'">Delete</button>
                                    <button type='button' class="btn btn-primary btn-sm" onclick="location.href='/editCourse/{{ $course->id }}'">Edit</button>
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
