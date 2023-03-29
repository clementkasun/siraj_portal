@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('pageStyles')
<style>
    .error .has-error {
        color: red;
    }
</style>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/daterangepicker/daterangepicker.css">

<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">

<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">

<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/bs-stepper/css/bs-stepper.min.css">

<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/dropzone/min/dropzone.min.css">

<link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css?v=3.2.0">
<!-- datatables -->
<link rel="stylesheet" href="https://portal.sirajmanpower.lk/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://portal.sirajmanpower.lk/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://portal.sirajmanpower.lk/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- end datatables -->
@endsection
@section('content')
<section class="content-header">
</section>
<section class="content-header">
    <div class="container-fluid">
        @can('create-user')
        <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">Create New System User </h3>
        </div>
        <form id="user_registration_form">
            @csrf
        <div class="card-body">
        <div class="row">
        <div class="form-group col-md-4">
        <label for="exampleInputEmail1">First Name <span style="color: red;">*</span></label>
        <input id="firstName" name="firstName" type="text" class="form-control" placeholder="Enter First Name" value="{{old('firstName')}}" required>
        </div>
        <div class="form-group col-md-4">
        <label for="exampleInputPassword1">Last Name <span style="color: red;">*</span></label>
        <input id="lastName" name="lastName" type="text" class="form-control" placeholder="Enter Last Name" value="{{old('lastName')}}" required>
        </div>
        <div class="form-group col-md-4">
        <label for="exampleInputPassword1">Preffered Name <span style="color: red;">*</span></label>
        <input id="prefferedName" name="prefferedName" type="text" class="form-control" placeholder="Enter Preffered Name" value="{{old('prefferedName')}}" required>
        </div>
        </div>
        <div class="row">
        <div class="form-group col-md-12">
        <label for="exampleInputPassword1">Full Name</label>
        <input id="fullName" name="fullName" type="text" class="form-control" placeholder="Enter Full Name" value="{{old('fullName')}}">
        </div>
        </div>
        <div class="row">
        <div class="form-group col-md-4">
        <label for="exampleInputEmail1">Email <span style="color: red;">*</span></label>
        <input id="email" name="email" type="text" class="form-control" placeholder="Enter Email" value="{{old('email')}}" required>
        </div>
        <div class="form-group col-md-4">
        <label for="exampleInputPassword1">Mobile No</label>
        <input id="mobileNo" name="mobileNo" maxlength="10" type="text" class="form-control" placeholder="Enter Mobile No" value="{{old('mobileNo')}}">
        </div>
        <div class="form-group col-md-4">
        <label for="exampleInputPassword1">Land Phone No</label>
        <input id="landNo" name="landNo" type="text" maxlength="12" class="form-control" placeholder="Enter Land Phone No" value="{{old('landNo')}}">
        </div>
        </div>
        <div class="row">
        <div class="form-group col-md-12">
        <label for="exampleInputPassword1">Address</label>
        <textarea id="address" class="form-control" rows="3" placeholder="Enter Address" name="address">{{old('address')}}</textarea>
        </div>
        </div>
        <div class="row">
        <div class="form-group col-md-4">
        <label for="exampleInputEmail1">NIC <span style="color: red;">*</span></label>
        <input id="nic" name="nic" type="text" maxlength="12" class="form-control" placeholder="Enter NIC No" value="{{old('nic')}}" required>
        </div>
        <div class="form-group col-md-4">
        <label for="exampleInputPassword1">Birth Date</label>
        <input id="birthDate" name="birthDate" type="date" maxlength="12" class="form-control" placeholder="Enter Birth Date" value="{{old('birthDate')}}">
        </div>
        </div>
        <div class="row">
        <div class="form-group col-md-4">
        <label for="exampleInputEmail1">NIC Front Page Image <span style="color: red;">*</span> <code style="color: red;font-size: 12px;">(500 pixel * 500 pixel)</code></label>
        <div class="input-group">
            <div class="custom-file">
            <input id="nicImageFront" type="file" name="nicImageFront" class="custom-file-input" accept=".png, .jpeg, .jpg">
            <label class="custom-file-label" for="nicImageFront">Nic Image Front side </label>
            </div>
        </div>
        </div>
        <div class="form-group col-md-4">
        <label for="exampleInputEmail1">NIC Back Page Image <span style="color: red;">*</span> <code style="color: red;font-size: 12px;">(500 pixel * 500 pixel)</code></label>
        <div class="input-group">
            <div class="custom-file">
            <input id="nicImageBack" type="file" name="nicImageBack" class="custom-file-input" accept=".png, .jpeg, .jpg">
            <label class="custom-file-label" for="nicImageBack">Nic Image Back side </label>
            </div>
        </div>
        </div>
        <div class="form-group col-md-4">
        <label for="exampleInputEmail1">User Profile Image <span style="color: red;">*</span> <code style="color: red;font-size: 12px;">(500 pixel * 500 pixel)</code></label>
        <div class="input-group">
            <div class="custom-file">
            <input id="userImage" type="file" name="userImage" class="custom-file-input" accept=".png, .jpeg, .jpg">
            <label class="custom-file-label" for="userImage"> User Image </label>
            </div>
        </div>
        </div>
        </div>
        <div class="row">
        <div class="form-group col-md-3">
        <label for="exampleInputEmail1">User Level</label>
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
        <div class="form-group col-md-3">
        <label for="exampleInputPassword1">User Role</label>
        <select id="role" class="form-control select2 select2-purple rollCombo" data-dropdown-css-class="select2-purple" style="width: 100%;" name="role">
        </select>
        </div>
        <div class="form-group col-md-3">
        <label for="exampleInputPassword1">Password <span style="color: red;">*</span></label>
        <input id="password" name="password" type="password" class="form-control" placeholder="Enter Password" value="{{old('password')}}" minlength="4" required>
        </div>
        <div class="form-group col-md-3">
        <label for="exampleInputPassword1">Confirm Password <span style="color: red;">*</span></label>
        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Enter Password" value="{{old('password_confirmation')}}" minlength="4" required>
        </div>
        </div>
        </div>
        <div class="card-footer">
        <button id="register_user" type="button" class="btn btn-success">Register</button>
        </div>
        </form>
        </div>
        @endcan
    </div>

        <div class="container-fluid">
        <div class="row">
            @can('view-user')
            <div class="col-12 col-md-12">
                <?php $status_color_array = ['Active' => 'badge badge-success', 'Inactive' => 'badge badge-danger', 'Archived' => 'badge badge-secondary'] ?>
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">All System Users</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Roll</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $indexKey=>$user)
                                @if(isset($user->role_id ))
                                <tr>
                                    <td>{{$indexKey+1}}.</td>
                                    <td><img src="{{($user->user_image != null) ? $user->user_image : url('/dist/img/avatar5.png')}}" width="70px" height="70px" alt="User Image" /></td>
                                    <td>{{ ($user->first_name != null) ? $user->first_name : '-' }}</td>
                                    <td>{{ ($user->last_name != null) ? $user->last_name : '-'}}</td>
                                    <td>{{ $user->Role->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><span class="p-2 {{ ($user->status != '') ? $status_color_array[$user->status] : '' }}"> {{ ($user->status != '') ? $user->status : '' }} </span></td>
                                    <td>
                                        @can('update-user')
                                        <a href="/users/id/{{$user->id}}" class="btn btn-sm btn-primary">Select</a>
                                        @else
                                        <a href="" class="btn btn-sm btn-primary" style="pointer-events: none; cursor: default;">Select</a>
                                        @endcan 
                                        @can('view-user')
                                        <a href="/user_profile/id/{{$user->id}}" class="btn btn-sm btn-primary">Profile</a>
                                        @else
                                        <a href="#" class="btn btn-sm btn-primary" style="pointer-events: none; cursor: default;">Profile</a>
                                        @endcan
                                        @can('delete-user') 
                                        <button class="btn btn-sm btn-danger del" {{ ($user->id == auth()->user()->id) ? 'disabled' : '' }}> Delete </button>
                                        @else
                                        <button class="btn btn-sm btn-danger del" disabled> Delete </button>
                                        @endcan
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Roll</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            @endcan
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
<script src="{{ asset('plugins/checkImageSize/jquery.checkImageSize.min.js') }}"></script>
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- Page script -->
<script>
    $(function() {
        // load_deleted_user_table();

        $("#nicImageFront").checkImageSize({
            minWidth: 500,
            minHeight: 500,
            maxWidth: 500,
            maxHeight: 500,
            showError: true,
            ignoreError: false
        });

        $("#nicImageBack").checkImageSize({
            minWidth: 500,
            minHeight: 500,
            maxWidth: 500,
            maxHeight: 500,
            showError: true,
            ignoreError: false
        });

        // loading roll combo at page start
        loadRoles($('.levelCombo').val(), 'rollCombo');

        //Initialize Select2 Elements
        $('.select2').select2();
        $("#tblUsers").DataTable();
        loadRoles($('.levelCombo').val(), 'rollCombo');

        $('.levelCombo').change(function() {
            loadRoles(this.value, 'rollCombo');
        });

        $(document).on('click', '.del', function() {
            if (confirm('Are you sure you want to delete this user ?')) {
                ulploadFileWithData('/api/delete_user/id/' + $(this).attr('data-id'), null, function(result) {
                    if (result.status == 1) {
                        toastr.success('User deleting is successful!');
                        location.reload();
                        if (typeof callBack !== 'undefined' && callBack != null && typeof callBack === "function") {
                            callBack();
                        }
                    } else {
                        toastr.error('User deleting was failed!');
                    }
                }, 'delete');
            }
        });

        $('#register_user').click(function() {
            if (!jQuery("#user_registration_form").valid() || !password_confirmation()) {
                return false;
            }
            let data = {
                'firstName': $('#firstName').val(),
                'lastName': $('#lastName').val(),
                'fullName': $('#fullName').val(),
                'prefferedName': $('#prefferedName').val(),
                'email': $('#email').val(),
                'address': $('#address').val(),
                'mobileNo': $('#mobileNo').val(),
                'landNo': $('#landNo').val(),
                'nic': $('#nic').val(),
                'nicFrontImg': $('#nicImageFront')[0].files[0],
                'nicBackImg': $('#nicImageBack')[0].files[0],
                'userImg': $('#userImage')[0].files[0],
                'birthDate': $('#birthDate').val(),
                'level': $('#level').val(),
                'role': $('#role').val(),
                'password': $('#password').val(),
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
<script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="https://adminlte.io/themes/v3/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- <script>
    $('#applicant_tbl').DataTable({
        "pageLength": 10,
        "destroy": true,
        "retrieve": true
    });
</script> -->
<!-- DataTables  & Plugins -->
<script src="https://portal.sirajmanpower.lk/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="https://portal.sirajmanpower.lk/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://portal.sirajmanpower.lk/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="https://portal.sirajmanpower.lk/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="https://portal.sirajmanpower.lk/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="https://portal.sirajmanpower.lk/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="https://portal.sirajmanpower.lk/plugins/jszip/jszip.min.js"></script>
<script src="https://portal.sirajmanpower.lk/plugins/pdfmake/pdfmake.min.js"></script>
<script src="https://portal.sirajmanpower.lk/plugins/pdfmake/vfs_fonts.js"></script>
<script src="https://portal.sirajmanpower.lk/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="https://portal.sirajmanpower.lk/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="https://portal.sirajmanpower.lk/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- end datatables -->

@endsection