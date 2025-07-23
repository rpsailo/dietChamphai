@extends('adminlte::page')

@section('title', 'Student')

@section('content_header')
    <h1>Student</h1>
@stop

@section('content')
    <p>Student Information</p>
    <p align = "right"><button type="button" class="btn btn-warning btn-sm" onclick="location.href='/newStudent'">New Student</button></p>
    @include('layout.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        Existing Faculty
                    </h3>
                </div>

                <div class="card-body">
                    <table id="myTable" class="table table-hover text-wrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Class Roll.No</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $key=>$student)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->classRollNo }}</td>
                                <td>

                                    @if($student->status == 0)
                                        In-Active
                                    @elseif($student->status == 1)
                                        Active
                                    @elseif($student->status == 2)
                                        Discontinue
                                    @elseif($student->status == 3)
                                        Passed Out
                                    @endif
                                </td>
                                <td>
                                    {{-- Custom --}}
                                    <x-adminlte-modal id="modalCustom{{ $student->id }}" title="Delete Warning" size="lg" theme="teal"
                                    icon="fas fa-bell" v-centered>
                                    <div style="height:100px;">Student Delete Remove all ralated Data</div>
                                    <x-slot name="footerSlot">
                                        <x-adminlte-button class="mr-auto" onclick="location.href='/deleteStudent/{{ $student->id }}'" theme="success" label="Yes"/>
                                        <x-adminlte-button theme="danger" label="No" data-dismiss="modal"/>
                                    </x-slot>
                                    </x-adminlte-modal>
                                    {{-- Example button to open modal --}}
                                    <button type='button' class="btn btn-danger btn-sm " data-toggle="modal" data-target="#modalCustom{{ $student->id }}">Delete</button>
                                    <button type='button' class="btn btn-primary btn-sm " onclick="location.href='{{ route('student.edit',$student) }}'"> Edit</button>
                                    <x-adminlte-modal id="view{{ $student->id }}" title="Student Details" size="lg" theme="teal"
                                        icon="fas fa-bell" v-centered static-backdrop scrollable>
                                        <div>
                                            @php
                                                /* $fac = $faculties->where('id',$faculty->id)->first();
                                                $user = $users->where('id',$fac->userId)->first(); */
                                            @endphp
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td>Academic Year</td>
                                                        <td>{{ $student->academicYear }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Name</td>
                                                        <td>{{ $student->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Class Roll No</td>
                                                        <td>{{ $student->classRollNo }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Board Roll No</td>
                                                        <td>{{ $student->boardRollNo }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Contact</td>
                                                        <td>{{ $student->contact }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Address</td>
                                                        <td>{{ $student->address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Date of Birth</td>
                                                        <td>{{ $student->dob }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Blood Group</td>
                                                        <td>{{ $student->bloodGroup }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Id Mark</td>
                                                        <td>{{ $student->idMark }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <x-slot name="footerSlot">
                                        </x-slot>
                                    </x-adminlte-modal>
                                    {{-- Example button to open modal --}}
                                    <button type='button' class="btn btn-success btn-sm " data-toggle="modal" data-target="#view{{ $student->id }}"><i class="fa fa-eye"></i> View</button>
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
