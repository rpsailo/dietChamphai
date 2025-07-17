@extends('adminlte::page')

@section('title', 'Attendance')

@section('content_header')
    <h1>Attendance</h1>
@stop

@section('content')
    <p>Select Subject</p>
    @include('layout.alert')
    <div class="row">
        <div class="col-md-5">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                       Attendance Marking
                    </h3>
                </div>

                <div class="card-body">
                    <table id="myTable" class="table table-hover text-wrap">
                        <thead>
                            <tr>
                                <th>Semester</th>
                                <th>Subject</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($facultySubjects as $fs)
                            <tr>
                                <td>
                                    {{ $fs->semesterId }} Semester
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="location.href='/markAttendance/{{ $fs->subjectId }}'">{{ $fs->subjectName }}</button>
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
