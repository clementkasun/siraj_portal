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
                <h2>Online Applicant Response</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    @can('create-online-applicant-resp')
                    <div class="col-md-3">
                        <form id="online_applicant_response_form">
                            <div class="form-group">
                                <label for="response">Response *</label>
                                <div><input type="text" class="form-control" name="response" id="response" placeholder="Please enter the phone response" required></div>
                            </div>
                            <div class="form-group">
                                <button id="save_online_app_response" type="button" class="btn btn-success pl-5 pr-5">Save</button>
                            </div>
                        </form>
                    </div>
                    @endcan
                    @can('view-online-applicant-resp')
                    <div class="col-md-9">
                        <table class="table table-striped" id="online_applicant_resp_tbl">
                            <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Added By</th>
                                <th>Response</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5" class="text-center text-bold"><span>No Data</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('pageScripts')
<script src="{{asset('js/online_app_response.js')}}"></script>
<script>
    var ONLINE_APPLICANT_ID = '{{$online_applicant_id}}';

    $(document).ready(function() {
        load_online_app_response_tbl();
    });
</script>
@endsection