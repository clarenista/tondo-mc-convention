@extends('layouts.cms')

@section('title')
Assets
@stop

@section('content')

<div class="d-flex">
    <div class="flex-fill">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Messages</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex p-3" style="padding-top: 0px !important; padding-right: 0px !important;">
        <a href="{{ route('cms.sponsor.messages.export.spreadsheet') }}" class="btn btn-primary">Export</a>
    </div>
</div>


<div class="row">
    <div class="col-sm col-lg">


        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Mobile Number</th>
                    <th class="text-center">Email Address</th>
                    <th class="text-center">Affiliation</th>
                    <th class="text-center">Classification</th>
                    <th class="text-center">Subject</th>
                    <th class="text-center">Interest</th>
                    <th class="text-center">Message</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                <tr>
                    <td>{{ $message->user->first_name . $message->user->last_name }}</td>
                    <td>{{ $message->user->mobile_number }}</td>
                    <td>{{ $message->user->email_address }}</td>
                    <td>{{ $message->user->affiliation }}</td>
                    <td>{{ $message->user->classification }}</td>
                    <td>{{ $message->subject }}</td>
                    <td>{{ $message->interest }}</td>
                    <td>{{ $message->message }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop


@section('js')

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>

@stop
