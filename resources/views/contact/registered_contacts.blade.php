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
                        <th>File</th>
                        <th>Message</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse($contacts as $key => $contact)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td style="width: 15em">{{ $contact->contact_name }}</td>
                            <td style="width: 15em">{{ $contact->companey_name }}</td>
                            <td style="width: 15em">{{ $contact->email }}</td>
                            <td>{{ $contact->phone_number }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td><a href="{{ ($contact->file != '') ? url('/storage/'.$contact->file) : '' }}" class="btn btn-primary btn-sm pl-5 pr-5" target="_blank">File</a></td>
                            <td style="width: 10em">{{ $contact->message }}</td>
                            <td><a href="/contact_response/id/{{ $contact->id }}" class="btn btn-success btn-sm">Respond</a></td>
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
    $('#contacts_tbl').DataTable({
        "pageLength": 10,
        "destroy": true,
        "retrieve": true
    });
</script>
@endsection