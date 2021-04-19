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
                    <th class="text-center">Description</th>
                    <th class="text-center">Date/Time of visit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($category->events as $event)
                <tr>
                    <td>{{ $event->user->first_name }}</td>
                    <td>{{ $event->user->last_name }}</td>
                    <td>{{ $event->user->email }}</td>
                    <td>{{ date('F d, Y - g:i:s A', strtotime($event->sent_at)) }}</td>
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
