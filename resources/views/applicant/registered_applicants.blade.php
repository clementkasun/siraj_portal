@extends('layouts.admin')
@extends('layouts.styles')
@extends('layouts.scripts')
@extends('layouts.navbar')
@extends('layouts.sidebar')
@extends('layouts.footer')
@section('content')
<?php use Illuminate\Support\Carbon; ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h2>Registered Applicants</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="applicant_tbl">
                    <thead>
                        <th>#</th>
                        <th>Reff. No</th>
                        <th>User Image</th>
                        <th>Full Name</th>
                        <th>Tel No 1</th>
                        <th>NIC</th>
                        <th>Passport No</th>
                        <th>Status</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse($applicants as $key => $applicant)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td style="width: 8em; font-weight: bold">{{ '#'.$applicant->reff_no }}</td>
                            <td>
                                <img src="{{ (isset($applicant->applicant_image_passport )) ? $applicant->applicant_image_passport : url('/dist/img/avatar5.png') }}" alt="applicant image" class="image-responsive" style="width: 100px; height: 100px" />
                            </td>
                            <td style="width: 15em">{{ $applicant->full_name }}</td>
                            <td>{{ $applicant->phone_no_01 }}</td>
                            <td>{{ $applicant->nic }}</td>
                            <td>{{ $applicant->passport_no }}</td>
                            <?php $status_style = (isset($applicant->post_status)) ? $post_status_array[$applicant->post_status]['color'] : '' ?>
                            <td><span class="btn btn-sm rounded text-dark" style="<?php echo 'background-color:' . $status_style ?>"><b>{{ (isset($applicant->post_status)) ? $post_status_array[$applicant->post_status]['name'] : '' }}</b></span></td>
                            <td>{{ Carbon::parse($applicant->created_at) }}</td>
                            <td>
                                <a href="/applicant_profile/id/{{ $applicant->id }}" class="btn btn-success btn-sm">Profile</a>
                                @can('update-offline-applicant')
                                <a href="/edit_applicant/id/{{ $applicant->id }}" class="btn btn-warning btn-sm">Edit</a>
                                @endcan
                                <a href="/view_application/id/{{ $applicant->id }}" class="btn btn-primary btn-sm">View Application</a>
                                <!-- <button type="button" class="btn btn-danger del" data-id="">Delete</button> -->
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center text-bold"><span>No Data</span></td>
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
    $('#applicant_tbl').DataTable({
        "pageLength": 10,
        "destroy": true,
        "retrieve": true
    });
</script>
@endsection