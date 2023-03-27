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
                            <td><a href="/online_applicant_response/id/{{ $online_applicant->id }}" class="btn btn-primary btn-sm m-1">Respond</a></td>
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
    $('#online_applicants').DataTable({
        "pageLength": 10,
        "destroy": true,
        "retrieve": true
    });
</script>
@endsection