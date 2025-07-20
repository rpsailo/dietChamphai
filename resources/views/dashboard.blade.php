@extends('adminlte::page')

@section('title', 'DIET, CHAMPHAI')

@section('content_header')
    <h1>Dashboard : {{ Auth::user()->role }}</h1>
@stop

@section('content')
    <p>Welcome to DIET, Champhai CMS</p>
    <hr>
    @include('layout.alert')
    <div class="container">
        <div class="row">
            @can('isStudent')
                <center><strong>Attendance of current month</strong></center>
                <hr>
                Name: {{ $student->name }} <br>
                Semester: {{ $student->currentSemester }} Semester <br>
                Roll No: {{ $student->classRollNo }} <br>
             @endcan
            <center><img src="/vendor/adminlte/dist/img/AdminLTELogo.png" alt="Logo" width=10%"></center>
            <hr>
            @can('isAdmin')
            Admin
            @endcan
            @can('isPrincipal')
            Principal
            @endcan
            @can('isFaculty')
            Faculty
            @endcan
            @can('isStudent')


            <table id="myTable" class="table table-hover text-wrap">

                <thead>
                    <tr>
                        <td>#</td>
                        <td>Subject</td>
                        <td>Faculty</td>
                        <td>No.of Class</td>
                        <td>No.of Present</td>
                        <td>No.of Leave</td>
                        <td>%</td>
                    </tr>
                </thead>
                <tbody>

                    @foreach($facultySubjects as $key=>$fs)
                    @php
                        $attendance = $attendances->where('subjectId',$fs->subjectId)
                            ->where('facultyId',$fs->facultyId);
                        $numClass = $attendance->count();
                        $numPresent = $attendance->sum('mark');
                        $numLeave = $attendance->sum('leave');
                    @endphp
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $fs->subjectName }}</td>
                        <td>{{ $fs->facultyName }}</td>
                        <td>{{ $numClass }}</td>
                        <td>{{ $numPresent }}</td>
                        <td>{{ $numLeave }}</td>
                        <td>{{ $numPresent == 0 ? "0" : ($numPresent * 100) / $numClass }} %</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            @endcan
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("DIET, Champhai"); </script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>

@stop
