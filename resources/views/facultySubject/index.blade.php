@extends('adminlte::page')

@section('title', 'Create Faculty Subject')

@section('content_header')
    <h1>Faculty Subject</h1>
@stop

@section('content')
    <p>Faculty Subject</p>
    @include('layout.alert')
    <div class="row">
        <div class="col-md-5">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        Selelect Semester with Course
                    </h3>
                </div>

                <div class="card-body">
                    <form method="GET" action="/selectSemesterCourse">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="course">Course</label>
                                <select name="course" id="" class="form-control" required>
                                    <option value="" selected>Select Course</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <select name="semester" id="" class="form-control" required>
                                    <option value="" selected>Select Semster</option>
                                    <option value="1">1 Semster</option>
                                    <option value="2">2 Semster</option>
                                    <option value="3">3 Semster</option>
                                    <option value="4">4 Semster</option>
                                    <option value="5">5 Semster</option>
                                    <option value="6">6 Semster</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type='submit' class='btn btn-success'><i class='fa fa-save'></i> Submit</button>
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
