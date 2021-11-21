@extends('layouts.cms')

@section('title')
    Chat
@stop

@section('content')

    <div class="d-flex">
        <div class="flex-fill">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Chat</li>
                </ol>
            </nav>
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
                        <th class="text-center">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($guests as $guest)
                        <tr>
                            <td>{{ $guest->first_name . $guest->last_name }}</td>
                            <td>{{ $guest->mobile_number }}</td>
                            <td>{{ $guest->email_address }}</td>
                            <td><a href="{{ route('cms.sponsor.chat.guest', $guest->id) }}" target="_blank">SEND MESSAGE</a></td>
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
        });
    </script>

@stop
