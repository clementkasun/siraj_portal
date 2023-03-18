@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 col-sm-6">
                <h1>System User Roles</h1>
            </div>
        </div>
    </div>
</section>

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-success">
                    <div class="card-header">
                        <label>Roles</label>
                    </div>
                    <div class="card-body">
                        <label>Level</label>
                        <select class="form-control select2 select2-purple levelCombo" data-dropdown-css-class="select2-purple" style="width: 100%;">

                            @foreach($levels as $level)
                            <option value="{{$level['id']}}">{{$level['name']}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="card-body">
                        <label>Role</label>
                        <div class="row">
                            <div class="col-md-10">
                                <select class="form-control select2 select2-purple rollCombo" data-dropdown-css-class="select2-purple" style="width: 100%;" id="rollCombo">


                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-success" id="btn_add_roll"><i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button id="btnUpdateModel" type="submit" class="btn btn-warning" data-toggle="modal" data-target="#modal-xl">Update</button>
                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger">Delete</button>
                    </div>

                    @if(count($errors) ||session('success'))
                    <div class="div_add_roll">
                        @else
                        <div class="d-none div_add_roll">
                            @endif
                            <form id="role_form">
                                @csrf
                                <div class="card-header">
                                    <label>Add new System Roll</label>
                                </div>
                                <div class="card-body">
                                    <label>Select Level</label>
                                    <select id="level" name="level" class="form-control select2 select2-purple" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                        @foreach($levels as $level)
                                        @if (old('level') == $level['id'])
                                        <option value="{{$level['id']}}" selected>{{$level['name']}}</option>
                                        @else
                                        <option value="{{$level['id']}}">{{$level['name']}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="card-body">
                                    <input id="role_name" name="role_name" type="text" class="form-control form-control-sm" placeholder="Enter the new role">
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-success" id="btnSaveRoll">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="modal-danger">
        <div class="modal-dialog">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Role</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>Are you sure you want to permanently delete this Role ? </b></p>
                    <p>Once you continue, this process can not be undone. Please Procede with care.</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="btnDelRole" type="submit" class="btn btn-danger" data-dismiss="modal">Delete Permanently</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Role</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-header">
                        <label>New Role Name</label>
                    </div>
                    <input id="txtupdateRoleName" name="roll" type="text" class="form-control form-control-sm" placeholder="Enter Roll..." value="{{old('expert')}}">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning" id="btnUpdateRole" data-dismiss="modal">Update Role</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</section>
@endsection

@section('pageScripts')
<script src="{{ asset('js/userjs/get.js') }}"></script>
<script src="{{ asset('js/userjs/submit.js') }}"></script>
<script>
    $(function() {
        @if(session('success'))
        Toast.fire({
            type: 'success',
            title: 'Agency Management System</br>Roll Saved'
        });
        @endif

        @if(session('error'))
        Toast.fire({
            type: 'error',
            title: 'Agency Management System</br>Error'
        });
        @endif

        $('#btnSaveRoll').click(function() {
            save_role();
        });

        save_role = () => {
            let data = {
                'role_name': $('#role_name').val(),
                'level': $('#level').val()
            };

            ajaxRequest('post', '/api/save_roles', data, function(result) {
                if(result.status == 1){
                    Toast.fire({
                        type: 'success',
                        title: 'Agency Management System</br> Role has created'
                    });
                    $('#role_form').trigger("reset");
                }else{
                    Toast.fire({
                        type: 'error',
                        title: 'Agency Management System</br> Role creation was failed'
                    });
                }
            });
        }

        //Initialize Select2 Elements
        $('.select2').select2();
        loadRoles($('.levelCombo').val(), 'rollCombo', function() {
            $('.rollCombo').change();
        });

        // loads system rolls to the roll combobox when level combo changes
        $('.levelCombo').change(function() {
            loadRoles(this.value, 'rollCombo', function() {
                $('.rollCombo', ).change();
            });
        });
        $('#btn_add_roll').click(function() {
            $('.div_add_roll').removeClass('d-none');
        });

        $("#btnDelRole").click(function() {
            deleteRole($('.rollCombo').val(), function(result) {
                if (result.id == 1) {
                    Toast.fire({
                        type: 'success',
                        title: 'Agency Management System</br>User Deleted'
                    });
                } else if (result.id == 2) {
                    Toast.fire({
                        type: 'error',
                        title: 'Agency Managemet System</br>Delete Failed'
                    });
                } else if (result.id == 3) {
                    Toast.fire({
                        type: 'warning',
                        title: '<h4>Can not delete while role is assigned to a user</h4>'
                    });
                } else {
                    Toast.fire({
                        type: 'error',
                        title: 'Agency Managemet System</br>Delete Failed'
                    });
                }
                location.reload();
            });
        });
        $("#btnUpdateModel").click(function() {
            $("#txtupdateRoleName").val($('.rollCombo').text());
        })

        $("#btnUpdateRole").click(function() {
            updateRole($('.rollCombo').val(), {
                "role_id": $("#txtupdateRoleName").val()
            }, function(result) {
                if (result.id == 1) {
                    Toast.fire({
                        type: 'success',
                        title: 'Agency Management System</br>Role Updated'
                    });
                } else if (result.id == 2) {
                    Toast.fire({
                        type: 'error',
                        title: 'Agency Managemet System</br>Update Failed'
                    });
                } else if (result.id == 3) {
                    Toast.fire({
                        type: 'warning',
                        title: '<h4>Can not Update</h4>'
                    });
                } else {
                    Toast.fire({
                        type: 'error',
                        title: 'Agency Managemet System</br>Delete Failed'
                    });
                }
                $('.select2').select2();
                loadRoles($('.levelCombo').val(), 'rollCombo', function() {
                    $('.rollCombo').change();
                });
            });
        });
    });
</script>
@endsection