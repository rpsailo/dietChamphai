@extends('adminlte::page')

@section('title', 'Create New Subject')

@section('content_header')
    <h1>Course</h1>
@stop

@section('content')
    <p>Create New Subject</p>
    @include('layout.alert')
    <div class="row">
        <div class="col-md-5">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        Create Subject
                    </h3>
                </div>

                <div class="card-body">
                    <form method="POST" action=" {{ route('subject.update', $subject->id) }}">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Course">Course Name</label>
                                <select name="courseId" id="" class="form-control" required>
                                    <option value="{{ $course->id }}" selected>{{ $course->name }}</option>
                                    @foreach($courses as $cou)
                                        <option value="{{ $cou->id }}">{{ $cou->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="faculty">Faculty</label>
                                <select name="facultyId" id="" class="form-control" required>
                                    <option value="{{ $faculty->id }}" selected>{{ $faculty->name }}</option>
                                    @foreach($faculties as $fa)
                                        <option value="{{ $fa->id }}">{{ $fa->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Subject Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $subject->name }}" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <input type="text" name="semester" class="form-control" value="{{ $subject->semester }}" autocomplete="off" required>
                            </div>
                            <div class="form-group">
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
                                <th>Course Name</th>
                                <th>Faculty Name</th>
                                <th>Subject Name</th>
                                <th>Semester</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subjects as $key=>$subject)
                            @php $course = $courses->where('id',$subject->courseId)->first() @endphp
                            @php $faculty = $faculties->where('id',$subject->facultyId)->first() @endphp
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $faculty->name }}</td>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $subject->semester }}</td>
                                <td>
                                    {{-- Custom --}}
                                    <x-adminlte-modal id="modalCustom{{ $subject->id }}" title="Delete Warning" size="lg" theme="teal"
                                    icon="fas fa-bell" v-centered>
                                    <div style="height:100px;">Subject Delete Remove all ralated Data</div>
                                    <x-slot name="footerSlot">
                                        <x-adminlte-button class="mr-auto" onclick="location.href='/deleteSubject/{{ $subject->id }}'" theme="success" label="Yes"/>
                                        <x-adminlte-button theme="danger" label="No" data-dismiss="modal"/>
                                    </x-slot>
                                    </x-adminlte-modal>
                                    {{-- Example button to open modal --}}
                                    <button type='button' class="btn btn-danger btn-sm " data-toggle="modal" data-target="#modalCustom{{ $subject->id }}">Delete</button>
                                    <button type='button' class="btn btn-primary btn-sm " onclick="location.href='/editSubject/{{ $subject->id }}'">Edit</button>
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
