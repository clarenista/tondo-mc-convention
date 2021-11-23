@extends('layouts.cms')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
            <p>Users</p>
            <form method="get" action="{{route('cms.syncUsers')}}">
                <button class="btn btn-success btn-sm" type="submit">Sync Users</button>
            </form>
        </li>
    </ol>
</nav>

<div class="row mb-3">
    <div class="col-sm col-lg">
        <a href="{{ route('cms.users.create') }}" class="btn btn-primary float-right">ADD NEW</a>
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
                    <th class="text-center">Email</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
               <tr>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-danger btn-delete" data-href="{{ route('cms.users.destroy', $user->id) }}" type="submit">delete</button>
                            <a href="{{ route('cms.users.edit', $user->id) }}" class="btn btn-info">edit</a>
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
    $(function(){
        
        $('#usersTable').DataTable();

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

