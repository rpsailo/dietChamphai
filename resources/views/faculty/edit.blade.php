@extends('adminlte::page')

@section('title', 'Edit Faculty')

@section('content_header')
    <h1>Faculty</h1>
@stop

@section('content')
    <p>Edit Faculty</p>
    @include('layout.alert')
    <div class="row">
        <div class="col-md-5">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        Faculty Information
                    </h3>
                </div>

                <div class="card-body">
                    <form method="POST" action=" {{ route('faculty.update', $faculty->id) }} ">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Faculty Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $faculty->name }}" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <input type="text" class="form-control" name="designation" value="{{ $faculty->designation }}" autocomplete='off' autofocus='on' required>
                            </div>
                            <div class="form-group">
                                <label for="fatherName">Father's Name</label>
                                <input type="text" class="form-control" name="fatherName" value="{{ $faculty->fatherName }}" autocomplete='off' autofocus='on'>
                            </div>
                            <div class="form-group">
                                <label for="motherName">Mother's Name</label>
                                <input type="text" class="form-control" name="motherName" value="{{ $faculty->motherName }}" autocomplete='off' autofocus='on'>
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" class="form-control" name="contact" value="{{ $faculty->contact }}" autocomplete='off' autofocus='on'>
                            </div>
                            <div class="form-group">
                                <label for="permanentAddress">Permanent Address</label>
                                <input type="text" class="form-control" name="permanentAddress" value="{{ $faculty->permanentAddress }}" autocomplete='off' autofocus='on'>
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control" name="dob" value="{{ $faculty->dob }}" autocomplete='off' autofocus='on'>
                            </div>
                            <div class="form-group">
                                <label for="bloodGroup">Blood Group</label>
                                <input type="text" class="form-control" name="bloodGroup" value="{{ $faculty->bloodGroup }}" autocomplete='off' autofocus='on'>
                            </div>

                            <div class="form-group">
                                <button type='submit' class='btn btn-success'><i class='fa fa-save'></i> Update</button>
                            </div>
                        </div>

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
                                        <x-adminlte-button class="mr-auto" onclick="location.href='/deleteFaculty/{{ $faculty->id }}'" theme="success" label="Yes"/>
                                        <x-adminlte-button theme="danger" label="No" data-dismiss="modal"/>
                                    </x-slot>
                                    </x-adminlte-modal>
                                    {{-- Example button to open modal --}}
                                    <button type='button' class="btn btn-danger btn-sm " data-toggle="modal" data-target="#modalCustom{{ $faculty->id }}">Delete</button>
                                    <button type='button' class="btn btn-primary btn-sm " onclick="location.href='/editFaculty/{{ $faculty->id }}'">Edit</button>

                                    <x-adminlte-modal id="view{{ $faculty->id }}" title="Faculty Details" size="lg" theme="teal"
                                        icon="fas fa-bell" v-centered static-backdrop scrollable>
                                        <div>
                                            @php
                                                $fac = $faculties->where('id',$faculty->id)->first();
                                                $user = $users->where('id',$fac->userId)->first();
                                            @endphp
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td>Name</td>
                                                        <td>{{ $fac->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Designation</td>
                                                        <td>{{ $fac->designation }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>login email</td>
                                                        <td>{{ $user->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Father's Name</td>
                                                        <td>{{ $fac->fatherName }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mother's Name</td>
                                                        <td>{{ $fac->motherName }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Contact</td>
                                                        <td>{{ $fac->contact }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Permanent Address</td>
                                                        <td>{{ $fac->permanentAddress }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Date of Birth</td>
                                                        <td>{{ $fac->dob }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Blood Group</td>
                                                        <td>{{ $fac->bloodGroup }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <x-slot name="footerSlot">
                                        </x-slot>
                                    </x-adminlte-modal>
                                    {{-- Example button to open modal --}}
                                    <button type='button' class="btn btn-success btn-sm " data-toggle="modal" data-target="#view{{ $faculty->id }}">View</button>
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
