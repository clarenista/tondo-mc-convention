@extends('layouts.cms')

@section('title')
Assets
@stop

@section('content')

<div class="d-flex">
    <div class="flex-fill">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Quizzes</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex p-3" style="padding-top: 0px !important; padding-right: 0px !important;">
        <a href="{{ route('cms.sponsor.questionnaires.export.spreadsheet') }}" class="btn btn-primary">Export</a>
    </div>
</div>


<div class="row">
    <div class="col-sm col-lg">
        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Mobile Number</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Classification</th>
                    <th class="text-center">Score</th>
                </tr>
            </thead>
            <tbody>
                @foreach($answers as $answer)
                <tr>
                    <td>{{ $answer->user->first_name . $answer->user->last_name }}</td>
                    <td>{{ $answer->user->mobile_number }}</td>
                    <td>{{ $answer->user->email }}</td>
                    <td>{{ $answer->user->classification }}</td>
                    <td>{{ $answer->score }}</td>
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
