@extends('layouts.cms')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
            <p>Guests</p>
        </li>
    </ol>
</nav>

<div class="row mb-3">
    <div class="col-sm col-lg">
        {{-- <a href="{{ route('cms.guests.create') }}" class="btn btn-primary float-right">ADD NEW</a> --}}
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
                    <th class="text-center">#</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">PRC ID</th>
                    <th class="text-center">Affiliation</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Certificate Name</th>
                    <th class="text-center">Registration Date</th>
                    {{-- <th class="text-center">Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($guests as $i => $user)
               <tr>
                    <td>{{$i+1}}</td>
                    <td>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</td>
                    <td>{{ $user->prc_no }}</td>
                    <td>{{ $user->hospital_affiliation }}</td>
                    <td>{{ $user->email_address }}</td>
                    <td>{{ $user->name_on_cert }}</td>
                    <td>{{ $user->created_at }}</td>
                    {{-- <td>
                        <div class="btn-group">
                            <button class="btn btn-danger btn-delete" data-href="{{ route('cms.guests.destroy', $user->id) }}" type="submit">delete</button>
                            <a href="{{ route('cms.guests   .edit', $user->id) }}" class="btn btn-info">edit</a>
                        </div>
                    </td> --}}
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
    $(function(){

        $('#guests  Table').DataTable();

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
    })


</script>
@stop

