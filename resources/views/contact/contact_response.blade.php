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
                            </thead>
                            <tbody>
                                @forelse($contact_responses as $key => $contact_response)
                                <tr>
                                    <td> {{ ++$key }} </td>
                                    <td style="width: 15em"> {{ $contact_response->AddedBy->name}} </td>
                                    <td> {{ $contact_response->Designation->name }} </td>
                                    <td> {{ $contact_response->response}} </td>
                                    @empty
                                <tr>
                                    <td colspan="4" class="text-center text-bold"><span>No Data</span></td>
                                </tr>
                                @endforelse
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
    $('#contact_resp_tbl').DataTable({
        "pageLength": 10,
        "destroy": true,
        "retrieve": true
    });
</script>
@endsection