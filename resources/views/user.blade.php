@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('pageStyles')
<style>
    .error .has-error{
        color: red;
    }
</style>
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
            <div class="col-md-4">
                <div class="card card-success">
                    <div class="card-header">
                        <label>User Register</label>
                    </div>
                    <form id="user_registration_form">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>First Name*</label>
                                <input id="firstName" name="firstName" type="text" class="form-control form-control-sm" placeholder="Enter First Name" value="{{old('firstName')}}" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name*</label>
                                <input id="lastName" name="lastName" type="text" class="form-control form-control-sm" placeholder="Enter Last Name" value="{{old('lastName')}}" required>
                            </div>
                            <div class="form-group">
                                <label>Full Name</label>
                                <input id="fullName" name="fullName" type="text" class="form-control form-control-sm" placeholder="Enter Full Name" value="{{old('fullName')}}">
                            </div>
                            <div class="form-group">
                                <label>Preffered Name</label>
                                <input id="prefferedName" name="prefferedName" type="text" class="form-control form-control-sm" placeholder="Enter Preffered Name" value="{{old('prefferedName')}}" required>
                            </div>
                            <div class="form-group">
                                <label>Email*</label>
                                <input id="email" name="email" type="text" class="form-control form-control-sm" placeholder="Enter Email" value="{{old('email')}}" required>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea id="address" class="form-control form-control-sm" rows="3" placeholder="Enter Address" name="address">{{old('address')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Mobile No</label>
                                <input id="mobileNo" name="mobileNo" maxlength="10" type="text" class="form-control form-control-sm" placeholder="Enter mobile No" value="{{old('mobileNo')}}">
                            </div>
                            <div class="form-group">
                                <label>Land No</label>
                                <input id="landNo" name="landNo" type="text" maxlength="12" class="form-control form-control-sm" placeholder="Enter land no" value="{{old('landNo')}}">
                            </div>
                            <div class="form-group">
                                <label>NIC*</label>
                                <input id="nic" name="nic" type="text" maxlength="12" class="form-control form-control-sm" placeholder="Enter nic no" value="{{old('nic')}}" required>
                            </div>
                            <div class="form-group">
                                <label>Birth Date</label>
                                <input id="birthDate" name="birthDate" type="date" maxlength="12" class="form-control form-control-sm" placeholder="Enter Birth Date" value="{{old('birthDate')}}">
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
                            <div class="form-group">
                                <label>User Level</label>
                                <select id="level" class="form-control select2 select2-purple levelCombo" data-dropdown-css-class="select2-purple" style="width: 100%;" name="level">
                                    @foreach($levels as $level)
                                    @if (old('level') == $level['id'])
                                    <option value="{{$level['id']}}" selected>{{$level['name']}}</option>
                                    @else
                                    <option value="{{$level['id']}}">{{$level['name']}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>User Role</label>
                                <select id="role" class="form-control select2 select2-purple rollCombo" data-dropdown-css-class="select2-purple" style="width: 100%;" name="role">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input id="password" name="password" type="password" class="form-control form-control-sm" placeholder="Enter Password" value="{{old('password')}}" required>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control form-control-sm" placeholder="Enter Password" value="{{old('password_confirmation')}}" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="register_user" type="button" class="btn btn-success">Register</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <?php $status_color_array = ['Active' => 'badge badge-success', 'Inactive' => 'badge badge-danger', 'Archived' => 'badge badge-secondary'] ?>
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">All Users</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-condensed assignedPrivilages" id="tblUsers">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th style="width: 200px">Image</th>
                                    <th style="width: 200px">First Name</th>
                                    <th style="width: 200px">Last Name</th>
                                    <th style="width: 200px">Roll</th>
                                    <th style="width: 200px">e-mail</th>
                                    <th style="width: 200px">Status</th>
                                    <th style="width: 200px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $indexKey=>$user)
                                @if(isset($user->role_id ))
                                <tr>
                                    <td>{{$indexKey+1}}.</td>
                                    <td><img src="{{($user->user_image != null) ? $user->user_image : url('/dist/img/avatar5.png')}}" width="100px" height="100px" alt="User Image"/></td>
                                    <td>{{ ($user->first_name != null) ? $user->first_name : '-' }}</td>
                                    <td>{{ ($user->last_name != null) ? $user->last_name : '-'}}</td>
                                    <td>{{ $user->Role->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><span class="p-2 {{ ($user->status != '') ? $status_color_array[$user->status] : '' }}">{{ ($user->status != '') ? $user->status : '' }}</span></td>
                                    <td>
                                        <a href="/users/id/{{$user->id}}" class="btn btn-sm btn-success">Select</a>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Deleted Users</h3>
                                <div class="card-tools"></div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="height:300px;">
                                <table class="table table-head-fixed" id="tbl_deleted_users">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Deleted at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="modal-footer justify-content-right">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    </div>
</section>
@endsection
@section('pageScripts')
<script src="{{ asset('js/userjs/get.js') }}"></script>
<script src="{{ asset('js/userjs/submit.js') }}"></script>
<script src="{{ asset('js/userjs/user_nic_validation.js') }}"></script>
<!-- Page script -->
<script>
    $(function() {
        load_deleted_user_table();

        @if(session('success'))
        Toast.fire({
            type: 'success',
            title: 'Agency Management System</br>User Saved'
        });
        @endif

        @if(session('error'))
        Toast.fire({
            type: 'error',
            title: 'Agency Management System</br>Error'
        });
        @endif

        // loading roll combo at page start
        loadRoles($('.levelCombo').val(), 'rollCombo');

        //Initialize Select2 Elements
        $('.select2').select2();
        $("#tblUsers").DataTable();
        loadRoles($('.levelCombo').val(), 'rollCombo');

        $('.levelCombo').change(function() {
            loadRoles(this.value, 'rollCombo');
        });

        $(document).on('click', '.btnAction', function() {
            //var row = JSON.parse(decodeURIComponent($(this).data('row')));
            if (confirm('Are you sure you want to restore this user ?')) {
                activeDeletedUser($(this).val());
            }
        });

        $('#register_user').click(function() {
            if (!jQuery("#user_registration_form").valid() || !password_confirmation()) {
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
                'level': $('#level').val(),
                'role': $('#role').val(),
                'password': $('#user_password').val(),
            };
            is_user_email_or_nic_exist(data, function(response) {
                if (response == true) {
                    return false;
                } else {
                    ulploadFileWithData('/api/save_user', data, function(result) {
                        if (result.status == 1) {
                            toastr.success('User saving is successful!');
                            location.reload();
                            if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                                callBack();
                            }
                        } else {
                            toastr.error('User saving was failed!');
                        }
                    });
                }
            });
        });

        password_confirmation = () => {
            if ($('#password').val() != $('#password_confirmation').val()) {
                ;
                toastr.error('Password confirmation failed!')
                return false;
            } else {
                return true;
            }
        }

        $("#user_registration_form").validate({
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
                user_password: {
                    valid_code: true,
                },
                password_confirmation: {
                    valid_code: true,
                }
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