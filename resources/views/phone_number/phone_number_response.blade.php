@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('content')
@extends('layouts.footer')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h2>Mobile Number Registration</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <form id="phone_number_respone_form">
                            <div class="form-group">
                                <label for="response"> Response *</label>
                                <div><input type="text" class="form-control" name="response" id="response" placeholder="Please enter the response" required></div>
                            </div>
                            <div class="form-group">
                                <button id="save_phone_number_response" type="button" class="btn btn-success pl-5 pr-5">Save</button>
                                <button id="update_phone_number_response" type="button" class="btn btn-warning pl-5 pr-5 d-none">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-9">
                        <table class="table table-striped" id="phone_number_response_tbl">
                            <thead>
                                <th>#</th>
                                <th>Phone number</th>
                                <th>Response</th>
                                <th>Designation</th>
                                <th>Created user</th>
                                <th>Created at</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6" class="text-center text-bold"><span>No Data</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('pageScripts')
<script src="{{asset('js/phone_number_response.js')}}"></script>
<script>
    var PHONE_NUMBER_ID = '{{$phone_number_id}}';
    $(document).ready(function() {
        load_phone_number_resp_tbl();
    });
</script>
@endsection