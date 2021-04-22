@extends('layouts.cms')

@section('title')
Assets
@stop

@section('content')

<div class="d-flex">
    <div class="flex-fill">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Visitors</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex p-3" style="padding-top: 0px !important; padding-right: 0px !important;">
        <a href="{{ route('cms.sponsor.visitors.export.spreadsheet') }}" class="btn btn-primary">Export</a>
    </div>
</div>

<div class="row">
    <div class="col-sm col-lg">
        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-center">First Name</th>
                    <th class="text-center">Last Name</th>
                    <th class="text-center">Mobile Number</th>
                    <th class="text-center">Email Address</th>
                    <th class="text-center">Affiliation</th>
                    <th class="text-center">Classification</th>
                </tr>
            </thead>
            <tbody>
                @foreach($category->events as $event)
                <tr>
                    <td>{{ $event->user->first_name }}</td>
                    <td>{{ $event->user->last_name }}</td>
                    <td>{{ $event->user->mobile_number }}</td>
                    <td>{{ $event->user->email_address }}</td>
                    <td>{{ $event->user->affiliation }}</td>
                    <td>{{ $event->user->classification }}</td>
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
