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
                <h2>Registered Applicants</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="applicant_tbl">
                    <thead>
                        <th>#</th>
                        <th>User Image</th>
                        <th>Full Name</th>
                        <th>Tel No 1</th>
                        <th>NIC</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>action</th>
                    </thead>
                    <tbody>
                        @forelse($applicants as $key => $applicant)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td><img src="{{ (isset($applicant->applicant_image )) ? $applicant->applicant_image : '/dist/img/no-image.jpg' }}" alt="applicant image" class="image-responsive" style="width: 100px; height: 100px" /></td>
                            <td style="width: 15em">{{ $applicant->full_name }}</td>
                            <td>{{ $applicant->phone_no_01 }}</td>
                            <td>{{ $applicant->nic }}</td>
                            <td>{{ $applicant->address }}</td>
                            <td>{{ (isset($applicant->post_status)) ? $applicant->status[$applicant->post_status] : '' }}</td>
                            <td>
                                <a href="/applicant_profile/id/{{ $applicant->id }}" class="btn btn-success">Profile</a>
                                <a href="/edit_applicant/id/{{ $applicant->id }}" class="btn btn-warning">Edit</a>
                                <a href="/view_application/id/{{ $applicant->id }}" class="btn btn-primary">View Application</a>
                                <button type="button" class="btn btn-danger del" data-id="{{ $applicant->id }}">Delete</button>
                            </td>
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
    $('#applicant_tbl').DataTable({
        "pageLength": 10,
        "destroy": true,
        "retrieve": true
    });
    $(document).on('click', '.del', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "Record will be deleted!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                let id = $(this).attr('data-id');
                delete_applicant(id);
            }
        });
    });

    delete_applicant = (id) => {
        ajaxRequest('delete', '/api/delete_applicant/id/' + id, null, function(result) {
            if (result.status == 1) {
                location.reload();
                toastr.success('Deleting applicant was successful!')
            } else {
                toastr.error('Deleting applicant was failed!');
            }
        });
    }
</script>
@endsection