@extends('layouts.cms')

@section('title')
Assets
@stop

@section('content')

<div class="d-flex">
    <div class="flex-fill">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Events</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex p-3" style="padding-top: 0px !important; padding-right: 0px !important;">
        <a href="{{ route('cms.sponsor.events.export.spreadsheet') }}" class="btn btn-primary">Export</a>
    </div>
</div>

<div class="row">
    <div class="col-sm col-lg">
        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach($category->events as $event)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $event->label }}</td>
                    <td>{{ $event->count }}</td>
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
