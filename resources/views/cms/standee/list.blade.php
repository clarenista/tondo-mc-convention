@extends('layouts.cms')

@section('title')
Standees
@stop

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Stabdees</li>
    </ol>
</nav>

<div class="row mb-3">
    <div class="col-sm col-lg">
        <a href="{{ route('cms.standees.create') }}" class="btn btn-primary float-right">ADD NEW</a>
    </div>
</div>


<div class="row">
    <div class="col-sm col-lg">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        @endif

        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($standees as $standee)
               <tr>
                    <td>{{ $standee->name }}</td>
                    <td>{{ $standee->active }}</td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-danger btn-delete" type="submit" data-href="{{ route('cms.standees.destroy', $standee->id) }}">delete</button>
                            <a href="{{ route('cms.standees.edit', $standee->id) }}" class="btn btn-info">edit</a>
                        </div>
                    </td>
               </tr>
               @endforeach
            </tbody>
        </table>
    </div>

    </div>
</div>
@stop


@section('js')

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );

    $(".btn-delete").click(function() {

        if (confirm('Are you sure you want to delete?')) {
            $.ajax({
                url: $(this).data('href'),
                type: 'DELETE',
                success: function(response) {
                    console.log(response);
                    location.reload();
                }
            });
        }

    });
</script>

@stop
