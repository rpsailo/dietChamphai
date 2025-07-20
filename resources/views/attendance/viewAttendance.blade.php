@extends('adminlte::page')

@section('title', 'Mark Attendance')

@section('content_header')
    <h1>View Attendance for the month of {{ date('M') }}</h1>
@stop

@section('content')
    @include('layout.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        Student List
                    </h3>
                </div>

                <div class="card-body">
                    <strong>
                    Date : {{ date('M') }} <br>
                    Subject : {{ $subject->name }} <br>
                    Semester : {{ $subject->semester }} Sem <br>
                    Faculty : {{ $faculty->name }} <br>
                    </strong>
                    <hr>
                    <form method="GET" action=" /viewAttendanceMonth ">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="form-group col-sm-2">
                            <label for="search">Search Month</label>
                            <input type="month" class="form-control" name="month" autocomplete='off' autofocus='on' required>
                        </div>
                        <div class="form-group">
                            <label for="search"></label>
                            <input type="hidden" name="subjectId" value="{{ $subject->id }}">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </form>
                    <div class="card-body">
                        <table width="100%" border="1" cellspacing="2" cellpadding="2">
                            <thead>
                                <tr>
                                    <th>Roll No</th>
                                    <th>Student</th>
                                    <th>No. of Class</th>
                                    <th>No. of Present</th>
                                    <th>No. of Leave</th>
                                    <th>Parcentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                @php $attend = $attendance->where('studentId',$student->id) @endphp
                                @php $numClass = $attend->count('mark') @endphp
                                @php $numPresent = $attend->sum('mark') @endphp
                                @php $numLeave = $attend->sum('leave') @endphp
                                <tr>
                                    <td>{{ $student->classRollNo }}</td>
                                    <td>{{ $student->name}}</td>
                                    <td align="center">{{ $numClass }}</td>
                                    <td align="center">{{ $numPresent }}</td>
                                    <td align="center">{{ $numLeave }}</td>
                                    <td align="center">{{ ($numPresent * 100) / $numClass }} %</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
