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
                <h2>Registered Contacts</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="contacts_tbl">
                    <thead>
                        <th>#</th>
                        <th>Contact Name</th>
                        <th>Companey Name</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>File</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse($contacts as $key => $contact)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td style="width: 10em">{{ $contact->contact_name }}</td>
                            <td style="width: 15em">{{ $contact->companey_name }}</td>
                            <td style="width: 15em">{{ $contact->email }}</td>
                            <td>{{ $contact->phone_number }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td style="width: 10em">{{ $contact->message }}</td>
                            <td>
                                @can('view-contact-us')
                                <a href="{{ ($contact->file != '') ? url('/storage/'.$contact->file) : '' }}" class="btn btn-primary btn-sm pl-3 pr-3" target="_blank">File</a>
                                @endcan
                            </td>
                            <td>
                                @can('update-contact-us')
                                <select id="contact_status" class="form-control form-control-sm">
                                    <option value="New"> New </option>
                                    <option value="Ongoing"> Ongoing </option>
                                    <option value="Complete"> Complete </option>
                                </select>
                                @endcan
                            </td>
                            <td style="width: 8em">
                                @can('update-contact-us')
                                <a href="/contact_response/id/{{ $contact->id }}" class="btn btn-success btn-sm">Respond</a>
                                @endcan
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
    var CONTACT_ID = '{{ (isset($contact)) ? $contact->id : "" }}';
    let CONTACT_STATUS = '{{ (isset($contact)) ? $contact->status : "" }}';

    $('#contacts_tbl').DataTable({
        "pageLength": 10,
        "destroy": true,
        "retrieve": true
    });

    if (CONTACT_STATUS == 'New') {
        $('#contact_status').addClass('bg-primary');
    }

    if (CONTACT_STATUS == 'Ongoing') {
        $('#contact_status').addClass('bg-warning');
    }

    if (CONTACT_STATUS == 'Complete') {
        $('#contact_status').addClass('bg-success');
    }

    $('#contact_status').val(CONTACT_STATUS);

    $('#contact_status').change(function() {
        let data = {
            'status': $('#contact_status').val()
        };
        update_contact_status(data);
    });

    update_contact_status = (data) => {
        ulploadFileWithData('/api/change_contact_status/id/' + CONTACT_ID, data, function(result) {
            if (result.status) {
                toastr.success('Contact status change is successful!');
                setTimeout(function() {
                    location.reload();
                }, 1000);
            } else {
                toastr.error('Contact status change is unsuccessful!');
            }
        });
    }
</script>
@endsection