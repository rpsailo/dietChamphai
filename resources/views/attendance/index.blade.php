@extends('adminlte::page')

@section('title', 'Attendance')

@section('content_header')
    <h1>Attendance</h1>
@stop

@section('content')
    <p>Select Subject</p>
    @include('layout.alert')
    <div class="row">
        <div class="col-md-12">
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
                                <th>Attendance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($facultySubjects as $fs)
                            <tr>
                                <td>{{ $fs->semesterId }} Semester</td>
                                <td>{{ $fs->subjectName }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="location.href='/markAttendance/{{ $fs->subjectId }}'">Mark Attendance</button>
                                </td>
                                <td>
                                    <form method="GET" name="editAttendance{{ $fs->subjectId }}" action="/editAttendance">
                                        @csrf
                                        <input name="_method" type="hidden" value="PATCH">
                                        <div style="float:left">
                                            <input type="date" name="date" class="form-control" required>
                                        </div>
                                        <div style="float:left">
                                            <input type="hidden" name="fsId" value="{{ $fs->id }}">
                                            <input type="hidden" name="subjectId" value="{{ $fs->subjectId }}">
                                            <button type="submit" class="brn btn-success btn-sm" >Edit Attendance</button>
                                        </div>
                                    </form>
                                    <div style="float:left">
                                        <form method="GET" name="viewAttendance{{ $fs->subjectId }}" action="/viewAttendance">
                                            @csrf
                                            <input name="_method" type="hidden" value="PATCH">
                                            <input type="hidden" name="fsId" value="{{ $fs->id }}">
                                            <input type="hidden" name="subjectId" value="{{ $fs->subjectId }}">
                                            <button type="submit" class="brn btn-info btn-sm" id="va{{ $fs->id  }}" >View Attendance</button>
                                        </form>
                                    </div>
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
