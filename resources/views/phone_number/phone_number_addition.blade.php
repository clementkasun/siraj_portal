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
                    @can('create-phone-number')
                    <div class="col-md-3">
                        <form id="phone_number_form">
                            <div class="form-group">
                                <label for="name">Name *</label>
                                <div><input type="text" class="form-control" name="name" id="name" placeholder="Please enter the name"></div>
                            </div>
                            <div class="form-group">
                                <label for="phone_number"> Phone Number *</label>
                                <div><input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Please enter the phone number" required></div>
                            </div>
                            <div class="form-group">
                                <button id="save_phone_number" type="button" class="btn btn-success pl-5 pr-5">Save</button>
                                <button id="update_phone_number" type="button" class="btn btn-warning pl-5 pr-5 d-none">Update</button>
                            </div>
                        </form>
                    </div>
                    @endcan
                    @can('view-phone-number')
                    <div class="col-12 col-md-9">
                        <table class="table table-striped" id="phone_number_tbl">
                            <thead>
                                <th>#</th>
                                <th>Phone Number</th>
                                <th>Name</th>
                                <th>Added By</th>
                                <th>Assigned To</th>
                                <th>Response</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse($phone_number_data as $key=> $phone_number)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td style="width: 8em">{{ $phone_number->phone_number }}</td>
                                    <td>{{ (isset($phone_number->name)) ? $phone_number->name : '' }}</td>
                                    <td>{{ (isset($phone_number->AddedBy)) ? ($phone_number->AddedBy->preffered_name != null) ? $phone_number->AddedBy->preffered_name : '' : '' }}</td>
                                    <td>{{ (isset($phone_number->AssignedTo)) ? ($phone_number->AssignedTo->preffered_name != null) ? $phone_number->AssignedTo->preffered_name : '' : '' }}</td>
                                    <td>{{ (isset($phone_number->PhoneNumberResponse)) ? (isset($phone_number->PhoneNumberResponse[0])) ? $phone_number->PhoneNumberResponse[0]->response : '' : '' }}</td>
                                    <td>
                                        @can('update-phone-number')
                                        <button type="button" class="btn btn-primary btn-sm edit m-1" data-id="{{ $phone_number->id }}"> Edit </button>
                                        @endcan
                                        @can('create-phone-number-response')
                                        <a href="/phone_number_response/id/{{ $phone_number->id }}" class="btn btn-primary btn-sm m-1">Response</a>
                                        @endcan
                                        @can('delete-phone-number')
                                        <button type="button" class="btn btn-danger btn-sm delete m-1" data-id="{{ $phone_number->id }}"> Delete </button>
                                        @endcan
                                        @can('view-phone-number')
                                        <a href="/phone_number_profile/id/{{ $phone_number->id }}" class="btn btn-success btn-sm m-1">Profile</a>
                                        @endcan
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-bold"><span>No Data</span></td>
                                </tr>
                                @endforelse
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
<script src="{{asset('js/phone_number.js')}}"></script>
<script>
    $('#phone_number_tbl').DataTable({
        "pageLength": 10,
        "destroy": true,
        "retrieve": true
    });
</script>
@endsection