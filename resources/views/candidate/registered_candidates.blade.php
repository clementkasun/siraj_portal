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
                <h2>Registered Candidates</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="candiates_tbl">
                    <thead>
                        <th>#</th>
                        <th>Candidate Name</th>
                        <th>Address</th>
                        <th>Birth Date</th>
                        <th>Phone No</th>
                        <th>Passport No</th>
                        <th>Job Type</th>
                        <th>Country</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse($candidates as $key => $candidate)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td style="width: 15em">{{ $candidate->candidate_name }}</td>
                            <td style="width: 15em">{{ $candidate->address }}</td>
                            <td>{{ $candidate->birth_date }}</td>
                            <td>{{ $candidate->phone_number }}</td>
                            <td>{{ $candidate->passport_number }}</td>
                            <td>{{ $candidate->job_type }}</td>
                            <td>{{ $candidate->country }}</td>
                            <td><a href="/candidate_reponse/id/{{ $candidate->id }}" class="btn btn-success">Respond</a></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-bold"><span>No Data</span></td>
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
    $('#candiates_tbl').DataTable({
        "pageLength": 10,
        "destroy": true,
        "retrieve": true
    });
</script>
@endsection