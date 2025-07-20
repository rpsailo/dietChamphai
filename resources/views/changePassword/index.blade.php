@extends('adminlte::page')

@section('title', 'Change Password')

@section('content_header')
    <h1>Change Password</h1>
@stop

@section('content')
    <p></p>
    @include('layout.alert')
    <div class="row">
        <div class="col-md-5">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        Change your current Password
                    </h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('changePassword.update', $user->id) }}">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="newPassword">New Password</label>
                                <input type="password" name="newPassword" id="password" class="form-control" placeholder="Enter New Password" autocomplete="off" autofocus required>
                            </div>
                            <div id="password-error" style="color: red;"></div>

                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password</label>
                                <input type="password" name="confirmPassword" id="confirmPassword"  class="form-control" placeholder="Enter Confirm Password" autocomplete="off" required>
                            </div>

                            <div id="confirmpassword-error" style="color: red;"></div>

                            <div class="form-group">
                                <button type='submit' id="save" class='btn btn-success' disabled><i class='fa fa-save'></i> Save</button>
                            </div>
                            <hr>
                            <div>
                                <strong>Password Rules</strong>
                                <ul>
                                    <li>Minimum 8 characters</li>
                                    <li>Uppercase and lowercase letters(a-z,A-Z)</li>
                                    <li>Numbers(0-9)</li>
                                    <li>Symbols(/!@#$%^)</li>
                                </ul>

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
            $('#confirmPassword').on('input', function () {
                var confirmPassword = $(this).val();
                var password = $('#password').val();
                if(confirmPassword == password)
                {
                    $('#confirmpassword-error').text('Confirm Password is valid, Click Save Button').css('color', 'green');
                    $('#save').removeAttr('disabled');
                }
                else
                {
                    $('#confirmpassword-error').text('New Password and Confirm Password not match').css('color', 'red');
                }

            });

            $('#password').on('input', function () {
                var password = $(this).val();

                $.ajax({
                    url: '{{ route("validate.password") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        password: password
                    },
                    success: function (response) {
                        if (response.valid) {
                            $('#password-error').text('Password is valid').css('color', 'green');
                        } else {
                            $('#password-error').text('The password must be at least 8 characters, Aphabets, Numbers and Symbols').css('color', 'red');
                        }
                    }
                });
            });
        });
    </script>
@stop
