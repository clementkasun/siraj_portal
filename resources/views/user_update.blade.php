@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('pageStyles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
<!-- Google Font: Source Sans Pro -->
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 col-sm-6">
                <h1>System Users</h1>
            </div>
        </div>
    </div>
</section>

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div class="card card-success">
                    <div class="card-header">
                        <label>Update User Information</label>
                    </div>
                    <form id="user_update_form">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>First Name</label>
                                <input id="firstName" name="firstName" type="text" class="form-control form-control-sm" placeholder="Enter the First Name" value="{{ $user->first_name }}">
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input id="lastName" name="lastName" type="text" class="form-control form-control-sm" placeholder="Enter the Last Name" value="{{ $user->last_name }}">
                            </div>
                            <div class="form-group">
                                <label>Full Name</label>
                                <input id="fullName" name="fullName" type="text" class="form-control form-control-sm" placeholder="Enter the Full Name" value="{{ $user->full_name }}">
                            </div>
                            <div class="form-group">
                                <label>Preffered Name</label>
                                <input id="prefferedName" name="prefferedName" type="text" class="form-control form-control-sm" placeholder="Enter the Preffered Name" value="{{ $user->preffered_name }}">
                            </div>
                            <div class="form-group">
                                <label>Email*</label>
                                <input id="email" name="email" type="text" class="form-control form-control-sm" placeholder="Enter the Email Address" value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea id="address" class="form-control form-control-sm" rows="3" placeholder="Enter the Address" name="address">{{ $user->address }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Mobile No</label>
                                <input id="mobileNo" name="mobileNo" maxlength="10" type="text" class="form-control form-control-sm" placeholder="Enter the mobile No" value="{{ $user->mobile_no }}">
                            </div>
                            <div class="form-group">
                                <label>Land No</label>
                                <input id="landNo" name="landNo" type="text" maxlength="12" class="form-control form-control-sm" placeholder="Enter the land no" value="{{ $user->land_no }}">
                            </div>
                            <div class="form-group">
                                <label>NIC</label>
                                <input id="nic" name="nic" type="text" maxlength="12" class="form-control form-control-sm" placeholder="Enter the nic no" value="{{ $user->nic }}">
                            </div>
                            <div class="form-group">
                                <label>Birth Date</label>
                                <input id="birthDate" name="birthDate" type="date" maxlength="12" class="form-control form-control-sm" placeholder="Enter the Birth Date" value="{{ $user->birth_date }}">
                            </div>
                            <div class="form-group">
                                <label>Nic Image (Front side)</label>
                                <input id="nicImageFront" type="file" name="nicImageFront" class="form-control form-control-sm" accept=".png, .jpeg, .jpg">
                            </div>
                            <div class="form-group">
                                <label>Nic Image (Back side)</label>
                                <input id="nicImageBack" type="file" name="nicImageBack" class="form-control form-control-sm" accept=".png, .jpeg, .jpg">
                            </div>
                            <div class="form-group">
                                <label>User Image</label>
                                <input id="userImage" type="file" name="userImage" class="form-control form-control-sm" accept=".png, .jpeg, .jpg">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="update_user" type="button" class="btn btn-warning">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Privileges</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>User Level</label>
                            <input name="nic" type="text" class="form-control form-control-sm" value="{{$level['name']}}" disabled="true">
                        </div>
                        <div class="form-group">
                            <label>User Role</label>
                            <select class="form-control select2 select2-purple roleCombo" data-dropdown-css-class="select2-purple" style="width: 100%;" name="level">
                                @foreach($roles as $role)
                                @if ($user['role_id'] == $role['id'])
                                <option value="{{$role['id']}}" selected>{{$role['name']}}</option>

                                @else
                                <option value="{{$role['id']}}">{{$role['name']}}</option>
                                @endif
                                @endforeach

                            </select>
                        </div>
                        <table class="table table-condensed assignedPrivilages" id="as">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Privillage</th>
                                    <th style="width: 20px">Read</th>
                                    <th style="width: 20px">Write</th>
                                    <th style="width: 20px">Update</th>
                                    <th style="width: 20px">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($privillages as $indexKey =>$privillage)
                                <tr id="privillage{{$privillage['id']}}">
                                    <td>{{$indexKey+1}}.</td>
                                    <td>{{$privillage['name']}}</td>
                                    <td align="center"><input class="form-check-input read" type="checkbox" value="option1">
                                    </td>
                                    <td align="center">
                                        <input class="form-check-input write" type="checkbox" value="option1">
                                    </td>
                                    <td align="center">
                                        <input class="form-check-input update" type="checkbox" value="option1">
                                    </td>
                                    <td align="center">
                                        <input class="form-check-input delete" type="checkbox" value="option1">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" id="btnReset">Reset</button>
                        <button type="button" class="btn btn-success" id="btnSetRollPrivilege">Default Privilege
                        </button>
                        <button type="button" class="btn btn-warning" id="btnAssign">Assign</button>
                    </div>
                </div>
                <form method="POST" action="/users/password/{{$user['id']}}">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Credentials</h3>
                        </div>
                        <div class="card-body">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Password</label>
                                <input name="password" type="password" class="form-control form-control-sm" placeholder="Enter Password">
                                @error('password')
                                <p class="text-danger">{{$errors->first('password')}}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input name="password_confirmation" type="password" class="form-control form-control-sm" placeholder="Re-enter Password">
                                @error('password_confirmation')
                                <p class="text-danger">{{$errors->first('password_confirmation')}}</p>
                                @enderror
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning">Reset Password</button>
                        </div>

                    </div>
                </form>
                <form method="POST" action="/users/password/{{$user['id']}}">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">User Activity</h3>
                        </div>
                        <div class="card-body">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Active Status</label>
                                <select class="form-control select2 select2-purple activityCombo" data-dropdown-css-class="select2-purple" style="width: 100%;" name="level">
                                    @foreach($activitys as $key=>$activity)
                                    <option value="{{$key}}">{{$activity}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger">
                                Delete User
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modal-danger">
    <div class="modal-dialog">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Delete User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><b>Are you sure you want to permanently delete this user ? </b></p>
                <p>Once you continue, this process can not be undone. Change Active Status to
                    <b>Inactive</b> if you want to keep the user and disable from the system(Recommended)
                </p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light bg-secondary" data-dismiss="modal">Close</button>
                <form action="/users/id/{{$user['id']}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-light bg-danger">Delete Permanently</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

@section('pageScripts')
<script src="{{ asset('js/userjs/get.js') }}"></script>
<script src="{{ asset('js/userjs/submit.js') }}"></script>
<script>
    $(function() {
        //Initialize Select2 Elements
        var userId = "{{$user['id']}}";
        var roleId = "{{$user['role_id']}}";
        $('.select2').select2();
        loadPrivillages(roleId);

        // loading roll combo at page start
        loadRoles($('.levelCombo').val(), 'rollCombo');

        //Initialize Select2 Elements
        $('.select2').select2();
        $("#tblUsers").DataTable();
        loadRoles($('.levelCombo').val(), 'rollCombo');

        $('.levelCombo').change(function() {
            loadRoles(this.value, 'rollCombo');
        });

        function loadPrivillages(id) {
            $.ajax({
                type: "GET",
                headers: {
                    "Authorization": "Bearer " + $('meta[name=api-token]').attr("content"),
                    "Accept": "application/json"
                },
                url: "/rolls/rollPrivilege/" + id,
                contentType: false,
                dataType: "json",
                cache: false,
                processData: false,
                success: function(result) {
                    // alert(JSON.stringify(result));
                    $('.read').prop('checked', false);
                    $('.write').prop('checked', false);
                    $('.update').prop('checked', false);
                    $('.delete').prop('checked', false);
                    if (result.length > 0) {
                        $.each(result, function(key, value) {

                            if ($("#privillage" + value.id).length == 1) {

                                if (value.is_read == 1) {

                                    $("#privillage" + value.id + " .read").prop('checked', true);
                                } else {
                                    $("#privillage" + value.id + " .read").prop('checked', false);
                                }
                                if (value.is_create == 1) {

                                    $("#privillage" + value.id + " .write").prop('checked', true);
                                } else {
                                    $("#privillage" + value.id + " .write").prop('checked', false);
                                }
                                if (value.is_update == 1) {

                                    $("#privillage" + value.id + " .update").prop('checked', true);
                                } else {
                                    $("#privillage" + value.id + " .update").prop('checked', false);
                                }
                                if (value.is_delete == 1) {

                                    $("#privillage" + value.id + " .delete").prop('checked', true);
                                } else {
                                    $("#privillage" + value.id + " .delete").prop('checked', false);
                                }
                            } else {
                                alert('Error Privillage table not found');
                            }
                        });
                    } else {
                        console.log('No Privillages');
                    }
                }
            });
        }

        function loadUserPrivillages(id) {
            $(".roleCombo").val(roleId);
            $('.select2').select2();
            $.ajax({
                type: "GET",
                headers: {
                    "Authorization": "Bearer " + $('meta[name=api-token]').attr("content"),
                    "Accept": "application/json"
                },
                url: "/user/Privileges/" + id,
                contentType: false,
                dataType: "json",
                cache: false,
                processData: false,
                success: function(result) {
                    // alert(JSON.stringify(result));
                    $('.read').prop('checked', false);
                    $('.write').prop('checked', false);
                    $('.update').prop('checked', false);
                    $('.delete').prop('checked', false);
                    if (result.length > 0) {
                        $.each(result, function(key, value) {
                            if ($("#privillage" + value.id).length == 1) {
                                if (value.is_read == 1) {
                                    $("#privillage" + value.id + " .read").prop('checked', true);
                                } else {
                                    $("#privillage" + value.id + " .read").prop('checked', false);
                                }
                                if (value.is_create == 1) {
                                    $("#privillage" + value.id + " .write").prop('checked', true);
                                } else {
                                    $("#privillage" + value.id + " .write").prop('checked', false);
                                }
                                if (value.is_update == 1) {
                                    $("#privillage" + value.id + " .update").prop('checked', true);
                                } else {
                                    $("#privillage" + value.id + " .update").prop('checked', false);
                                }
                                if (value.is_delete == 1) {
                                    $("#privillage" + value.id + " .delete").prop('checked', true);
                                } else {
                                    $("#privillage" + value.id + " .delete").prop('checked', false);
                                }
                            } else {
                                alert('Error privillage table not found');
                            }
                        });
                    } else {
                        console.log('No privillages');
                    }
                }
            });
        }

        $('.roleCombo').change(function() {
            // load the default assigned privileges in a user roll
            loadPrivillages(this.value);
        });
        $('.activityCombo').change(function() {
            // alert(this.value);
            var data = {
                'status': this.value
            }
            changeAciveStatus(userId, data, function() {
                // alert('User Changes to \'' + $(".activityCombo option:selected").html() + '\' status');
                Toast.fire({
                    type: 'success',
                    title: 'Agency Management System</br>User Changes to \'' + $(".activityCombo option:selected").html() + '\' status'
                });
            });
        });
        $('#btnSetRollPrivilege').click(function() {
            loadPrivillages($('.roleCombo').val());
        });
        $('#btnReset').click(function() {
            // rest un saved privileges
            loadUserPrivillages(userId);
        });
        $('#btnAssign').click(function() {
            // saving privileges
            assignPrivillagesToUser(userId, function() {
                roleId = $('.roleCombo').val();
                Toast.fire({
                    type: 'success',
                    title: 'Agency Management System</br>Privillage changed successfully'
                });
                loadPrivillages(roleId);
            });
        });

        $('#update_user').click(function() {
            if (!jQuery("#user_update_form").valid()) {
                return false;
            }

            let data = {
                'firstName': $('#firstName').val(),
                'lastName': $('#firstName').val(),
                'fullName': $('#fullName').val(),
                'prefferedName': $('#prefferedName').val(),
                'email': $('#email').val(),
                'address': $('#address').val(),
                'mobileNo': $('#mobileNo').val(),
                'landNo': $('#landNo').val(),
                'nic': $('#nic').val(),
                'nicFrontImg': $('#nicImageFront')[0].files[0],
                'nicBackImg': $('#nicImageFront')[0].files[0],
                'userImg': $('#userImage')[0].files[0],
                'birthDate': $('#birthDate').val(),
            };

            is_email_or_nic_exist(data, function(response) {
                if (response == true) {
                    toastr.error('Email or NIC already exist, Please check and correct it!')
                    return false;
                } else {
                    ulploadFileWithData('/api/update_user/id/' + userId, data, function(result) {
                        if (result.status == 1) {
                            toastr.success('User details have successfully updated!')
                            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                                callBack();
                            }
                        } else {
                            Swal.fire(
                                'Update user',
                                result.msg,
                                'warning'
                            );
                            toastr.error('User Updating was failed! due to ' + result.msg);
                        }
                    });
                }
            });
        });

        var status = false;
        is_email_or_nic_exist = (data, callBack) => {
            ajaxRequest('post', '/api/is_nic_or_email_exist', data, function(result) {
                if (result == 1) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Record will be updated without nic and email, due to nic or email already exist! please check them!",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!'
                    }).then((result) => {
                        if (result.value) {
                            data.nic = null;
                            data.email = null;
                            status = false;
                        } else {
                            status = true;
                        }
                        if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                            callBack(status);
                        }
                    });
                } else {
                    status = false;
                    if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                        callBack(status);
                    }
                }
            });
        }

        $("#user_update_form").validate({
            errorClass: "invalid",
            rules: {
                firstName: {
                    valid_name: true,
                },
                lastName: {
                    valid_name: true,
                },
                fullName: {
                    valid_name: true,
                },
                prefferedName: {
                    valid_name: true,
                },
                email: {
                    valid_email: true,
                },
                address: {
                    valid_name: true,
                },
                mobileNo: {
                    valid_lk_phone: true,
                },
                landNo: {
                    valid_lk_phone: true,
                },
                nic: {
                    valid_nic: true,
                },
                birthDate: {
                    valid_date: true,
                },
            },
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            },
            errorElement: 'span',
            errorClass: 'validation-error-message help-block form-helper bold',
            errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });

        jQuery.validator.setDefaults({
            errorElement: "span",
            ignore: ":hidden:not(select.chosen-select)",
            errorPlacement: function(error, element) {
                // Add the `help-block` class to the error element
                error.addClass("help-block");
                if (element.prop("type") === "checkbox") {
                    //                error.insertAfter(element.parent("label"));
                    error.appendTo(element.parents("validate-parent"));
                } else if (element.is("select.chosen-select")) {
                    error.insertAfter(element.siblings(".chosen-container"));
                } else if (element.prop("type") === "radio") {
                    error.appendTo(element.parents("div.validate-parent"));
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function(element, errorClass, validClass) {
                jQuery(element).parents(".validate-parent").addClass("has-error").removeClass("has-success");
            },
            unhighlight: function(element, errorClass, validClass) {
                jQuery(element).parents(".validate-parent").removeClass("has-error");
            }
        });
        jQuery.validator.addMethod("valid_name", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9\s\.\&\-():, ]{1,100}$/.test(value);
        }, "Please enter a valid name");
        jQuery.validator.addMethod("valid_email", function(value, element) {
            return this.optional(element) || /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/.test(value);
        }, "Please enter a valid email addresss");
        jQuery.validator.addMethod("valid_code", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9._%+-@#()^;*!$=, ]{1,40}$/.test(value);
        }, "Please enter a valid password");
        jQuery.validator.addMethod("valid_lk_phone", function(value, element) {
            return this.optional(element) || /^(\+94)?\d{2,3}[-]?\d{7}$/.test(value);
        }, "Please enter a valid phone number");
        jQuery.validator.addMethod("valid_date", function(value, element) {
            return this.optional(element) || /^\d{4}\-\d{2}\-\d{2}$/.test(value);
        }, "Please enter a valid date ex. 2017-03-27");
        jQuery.validator.addMethod("valid_nic", function(value, element) {
            return this.optional(element) || /^[0-9+]{12}$/.test(value) || /^[0-9+]{9}[vV|xX]$/.test(value);
        }, "Please enter a valid nic number");
    })
</script>

@endsection