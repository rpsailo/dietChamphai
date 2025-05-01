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
                                <th>Regd.No</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>ID Mark</th>
                                <th>Semester</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $key=>$student)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->regdNo }}</td>
                                <td>{{ $student->contact }}</td>
                                <td>{{ $student->address }}</td>
                                <td>{{ $student->idMark }}</td>
                                <td>{{ $student->currentSemester }}</td>
                                <td>
                                    {{ $student->status }}
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
                                    <button type='button' class="btn btn-primary btn-sm " onclick="location.href='/editStudent/{{ $student->id }}'">Edit</button>
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
