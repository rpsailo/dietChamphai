@extends('adminlte::page')

@section('title', 'Mark Attendance')

@section('content_header')
    <h1>Edit Mark Attendance</h1>
@stop

@section('content')
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
                    <strong>
                    Date : {{ $date }} <br>
                    Subject : {{ $subject->name }} <br>
                    Semester : {{ $subject->semester }} Semester <br>
                    Faculty : {{ $faculty->name }} <br>
                    </strong>
                    <hr>
                    <form method="GET" action=" /updateEditAttendance ">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="card-body">
                            <table width="100%" border="1" cellspacing="2" cellpadding="2">
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
                                    @php $attend = $attendance->where('studentId',$student->id)->first() @endphp
                                    <tr>
                                        <td>{{ $student->classRollNo }}</td>
                                        <td>{{ $student->name }}</td>
                                        @if($attend->count())
                                            @if($attend->mark != null)
                                                <td><input class="custom-control" type="checkbox" name="attendance{{ $student->id }}"  checked></td>
                                            @else
                                                <td><input class="custom-control" type="checkbox" name="attendance{{ $student->id }}"  ></td>
                                            @endif

                                            @if($attend->leave != null)
                                                <td><input class="custom-control" type="checkbox" name="leave{{ $student->id }}"  checked ></td>
                                            @else
                                                <td><input class="custom-control" type="checkbox" name="leave{{ $student->id }}"  ></td>
                                            @endif
                                        @else
                                                <td><input class="custom-control" type="checkbox" name="attendance{{ $student->id }}"  ></td>
                                                <td><input class="custom-control" type="checkbox" name="leave{{ $student->id }}"  ></td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            <br>
                            <div class="form-group">
                                <input type="hidden" name="subjectId" value="{{ $subject->id }}">
                                <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="date" value="{{ $date }}">
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
