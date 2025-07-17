@extends('adminlte::page')

@section('title', 'Mark Attendance')

@section('content_header')
    <h1>Mark Attendance</h1>
@stop

@section('content')
    <p>{{ date('d-m-Y') }} Attendance for {{ $subject->name }} Subject</p>
    @include('layout.alert')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        Student List
                    </h3>
                </div>

                <div class="card-body">
                    <form method="POST" action=" {{ route('attendance.store') }} ">
                        @csrf
                        <div class="card-body">
                            <table id="myTable" class="table table-hover text-wrap">
                                <thead>
                                    <tr>
                                        <th>Roll No</th>
                                        <th>Student</th>
                                        <th>Attendance</th>
                                        <th>Leave</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                    <tr>
                                        <td>{{ $student->regdNo }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td><input class="custom-control" type="checkbox" name="attendance{{ $student->id }}"  ></td>
                                        <td><input class="custom-control" type="checkbox" name="leave{{ $student->id }}"  ></td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            <div class="form-group">
                                <input type="hidden" name="subjectId" value="{{ $subject->id }}">
                                <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
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
