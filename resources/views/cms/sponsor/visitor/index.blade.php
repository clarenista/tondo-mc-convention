@extends('layouts.cms')

@section('title')
Assets
@stop

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Visitors</li>
    </ol>
</nav>

<div class="row">
    <div class="col-sm col-lg">
        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-center">First Name</th>
                    <th class="text-center">Last Name</th>
                    <th class="text-center">Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach($category->events as $event)
                <tr>
                    <td>{{ $event->user->first_name }}</td>
                    <td>{{ $event->user->last_name }}</td>
                    <td>{{ $event->user->email }}</td>
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
