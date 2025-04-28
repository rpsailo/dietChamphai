@extends('adminlte::page')

@section('title', 'Create New Faculty')

@section('content_header')
    <h1>Faculty</h1>
@stop

@section('content')
    <p>Create New Faculty</p>
    @include('layout.alert')
    <div class="row">
        <div class="col-md-5">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        Faculty Details
                    </h3>
                </div>

                <div class="card-body">
                    <form method="POST" action=" {{ route('faculty.store') }} ">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="faculty">Faculty Name</label>
                                <input type="text" class="form-control" name="faculty" placeholder="Enter Course Name" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="fatherName">Father's Name</label>
                                <input type="text" class="form-control" name="fatherName" placeholder="Enter Short Name" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="motherName">Mother's Name</label>
                                <input type="text" class="form-control" name="motherName" placeholder="Enter No. of Semester" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" class="form-control" name="contact" placeholder="Enter No. of Semester" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="email">email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter No. of Semester" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="parmanentAddress">Parmanent Address</label>
                                <input type="text" class="form-control" name="parmanentAddress" placeholder="Enter No. of Semester" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control" name="dob" placeholder="Enter No. of Semester" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="bloodGroup">Blood Group</label>
                                <input type="text" class="form-control" name="bloodGroup" placeholder="Enter No. of Semester" autocomplete='off' autofocus='on' required>
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
                        Existing Faculty
                    </h3>
                </div>

                <div class="card-body">

                    <table id="myTable" class="table table-hover text-wrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($faculties as $key=>$faculty)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $faculty->name }}</td>
                                <td>{{ $faculty->permanentAddress }}</td>
                                <td>{{ $faculty->contact }}</td>
                                <td>
                                    {{-- Custom --}}
                                    <x-adminlte-modal id="modalCustom{{ $faculty->id }}" title="Delete Warning" size="lg" theme="teal"
                                    icon="fas fa-bell" v-centered>
                                    <div style="height:100px;">Faculty Delete Remove all ralated Data</div>
                                    <x-slot name="footerSlot">
                                        <x-adminlte-button class="mr-auto" onclick="location.href='/deleteFaulty/{{ $faculty->id }}'" theme="success" label="Yes"/>
                                        <x-adminlte-button theme="danger" label="No" data-dismiss="modal"/>
                                    </x-slot>
                                    </x-adminlte-modal>
                                    {{-- Example button to open modal --}}
                                    <button type='button' class="btn btn-danger btn-sm " data-toggle="modal" data-target="#modalCustom{{ $faculty->id }}">Delete</button>
                                    <button type='button' class="btn btn-primary btn-sm " onclick="location.href='/editFaculty/{{ $faculty->id }}'">Edit</button>
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
