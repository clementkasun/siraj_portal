@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h2>Registered Online Applicants</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="online_applicants">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Passport Number</th>
                        <th>NIC</th>
                        <th>Birth Date</th>
                        <th>Address</th>
                        <th>Phone No 01</th>
                        <th>Phone No 02</th>
                        <th>Job Type</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @forelse($online_applicants as $key => $online_applicant)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $online_applicant->applicant_name }}</td>
                            <td>{{ $online_applicant->passport_number }}</td>
                            <td>{{ $online_applicant->nic }}</td>
                            <td>{{ $online_applicant->birth_date }}</td>
                            <td>{{ $online_applicant->address }}</td>
                            <td>{{ $online_applicant->phone_no_01 }}</td>
                            <td>{{ $online_applicant->phone_no_02 }}</td>
                            <td>{{ $online_applicant->job_type }}</td>
                            <td>
                                @can('update-online-applicant')
                                <select id="online_app_status" class="form-control form-control-sm">
                                    <option value="New"> New </option>
                                    <option value="Ongoing"> Ongoing </option>
                                    <option value="Complete"> Complete </option>
                                </select>
                                @endcan
                            </td>
                            <td>
                                @can('update-online-applicant')
                                <a href="/online_applicant_response/id/{{ $online_applicant->id }}" class="btn btn-primary btn-sm">Respond</a>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-bold"><span>No Data</span></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
@section('pageScripts')
<script>
    var ONLINE_APPLICANT_ID = '{{ (isset($online_applicant)) ? $online_applicant->id : "" }}';
    var APPLICANT_STATUS = '{{ (isset($online_applicant)) ? $online_applicant->status : "" }}';

    // $('#online_applicants').DataTable({
    //     "pageLength": 10,
    //     "destroy": true,
    //     "retrieve": true
    // });

    if(APPLICANT_STATUS == 'New'){
        $('#online_app_status').addClass('bg-primary');
    }

    if(APPLICANT_STATUS == 'Ongoing'){
        $('#online_app_status').addClass('bg-warning');
    }

    if(APPLICANT_STATUS == 'Complete'){
        $('#online_app_status').addClass('bg-success');
    }

    $('#online_app_status').val(APPLICANT_STATUS);

    $('#online_app_status').change(function() {
        let data = {
            'status': $('#online_app_status').val()
        };
        update_online_status(data);
    });

    update_online_status = (data) => {
        ulploadFileWithData('/api/change_online_app_status/id/' + ONLINE_APPLICANT_ID, data, function(result) {
            if (result.status) {
                toastr.success('Online applicant status change is successful!');
                setTimeout(function() {
                    location.reload();
                }, 1000);
            } else {
                toastr.error('Online applicant change was unsuccessful!');
            }
        });
    }
</script>
@endsection