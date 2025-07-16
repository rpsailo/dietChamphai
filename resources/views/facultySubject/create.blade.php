@extends('adminlte::page')

@section('title', 'Create Faculty Subject')

@section('content_header')
    <h1>Faculty Subject Mapping</h1>
@stop

@section('content')
    <p>Create Faculty Subject Mapping</p>
    @include('layout.alert')
    <div class="row">
        <div class="col-md-5">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        Faculty Subject
                    </h3>
                </div>

                <div class="card-body">
                    <form method="POST" action=" {{ route('facultySubject.store') }} ">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="faculty">Faculty</label>
                                <select name="faculty" id="" class="form-control" required>
                                    <option value="" selected>Select Faculty</option>
                                    @foreach($faculties as $faculty)
                                        <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <select name="subject" id="" class="form-control" required>
                                    <option value="" selected>Select Faculty</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="semester" value="{{ $semester }}">
                                <input type="hidden" name="courseId" value="{{ $courseId }}">
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
                        Existing Subject
                    </h3>
                </div>

                <div class="card-body">

                    <table id="myTable" class="table table-hover text-wrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Subject</th>
                                <th>Faculty</th>
                                <th>Semester</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($facultySubjects as $key=>$facultySubject)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $facultySubject->subjectName }}</td>
                                <td>{{ $facultySubject->facultyName }}</td>
                                <td>{{ $facultySubject->semesterId }} Semester</td>
                                <td>
                                    {{-- Custom --}}
                                    <x-adminlte-modal id="modalCustom{{ $subject->id }}" title="Delete Warning" size="lg" theme="teal"
                                    icon="fas fa-bell" v-centered>
                                    <div style="height:100px;">Are You Sure</div>
                                    <x-slot name="footerSlot">
                                        <x-adminlte-button class="mr-auto" onclick="location.href='/deleteFacultySubject/{{ $subject->id }}'" theme="success" label="Yes"/>
                                        <x-adminlte-button theme="danger" label="No" data-dismiss="modal"/>
                                    </x-slot>
                                    </x-adminlte-modal>
                                    {{-- Example button to open modal --}}
                                    <button type='button' class="btn btn-danger btn-sm " data-toggle="modal" data-target="#modalCustom{{ $facultySubject->id }}">Delete</button>
                                    <button type='button' class="btn btn-primary btn-sm " onclick="location.href='/editFacultySubject/{{ $facultySubject->id }}'">Edit</button>
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
