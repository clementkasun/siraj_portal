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
                <h2>Contact Response</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <form id="contact_response_form">
                            <div class="form-group">
                                <label for="name"> Name *</label>
                                <div><input type="text" class="form-control" name="name" id="name" placeholder="Please enter the name" required></div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="designation">Designation *</label>
                                <div><input type="text" class="form-control" name="designation" id="designation" placeholder="Please enter the designation" required></div>
                            </div> -->
                            <div class="form-group">
                                <label for="response">Response *</label>
                                <div><input type="text" class="form-control" name="response" id="response" placeholder="Please enter the phone response" required></div>
                            </div>
                            <div class="form-group">
                                <button id="save_contact_response" type="button" class="btn btn-success pl-5 pr-5">Save</button>
                                <button id="update_contact_response" type="button" class="btn btn-warning pl-5 pr-5 d-none">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-9">
                        <table class="table table-striped" id="contact_resp_tbl">
                            <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Response</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5" class="text-center text-bold"><span>No Data</span></td>
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
<script src="{{asset('js/contact_response.js')}}"></script>
<script>
    var CONTACT_ID = '{{$contact_id}}';

    $(document).ready(function() {
        load_contact_response();
    });
</script>
@endsection