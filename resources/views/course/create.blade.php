@extends('adminlte::page')

@section('title', 'Create New Course')

@section('content_header')
    <h1>Course</h1>
@stop

@section('content')
    <p>Create New Course</p>
    @include('layout.alert')
    <div class="row">
        <div class="col-md-5">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        Create Course
                    </h3>
                </div>

                <div class="card-body">
                    <form method="POST" action=" {{ route('course.store') }} ">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Course">Course Name</label>
                                <input type="text" class="form-control" name="Course" placeholder="Enter Course Name" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="short">Course Short Form</label>
                                <input type="text" class="form-control" name="short" placeholder="Enter Short Name" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="semester">No. of Semester</label>
                                <input type="number" class="form-control" name="semester" placeholder="Enter No. of Semester" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <button type='submit' class='btn btn-success'><i class='fa fa-save'></i> Save</button>
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
                                <th>Short Name</th>
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
                                    {{-- Custom --}}
                                    <x-adminlte-modal id="modalCustom{{ $course->id }}" title="Delete Warning" size="lg" theme="teal"
                                    icon="fas fa-bell" v-centered>
                                    <div style="height:100px;">Course Delete Remove all ralated Data</div>
                                    <x-slot name="footerSlot">
                                        <x-adminlte-button class="mr-auto" onclick="location.href='/deleteCourse/{{ $course->id }}'" theme="success" label="Yes"/>
                                        <x-adminlte-button theme="danger" label="No" data-dismiss="modal"/>
                                    </x-slot>
                                    </x-adminlte-modal>
                                    {{-- Example button to open modal --}}
                                    <button type='button' class="btn btn-danger btn-sm " data-toggle="modal" data-target="#modalCustom{{ $course->id }}">Delete</button>
                                    <button type='button' class="btn btn-primary btn-sm " onclick="location.href='/editCourse/{{ $course->id }}'">Edit</button>
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
