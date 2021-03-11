@extends('layouts.cms')

@section('title')
Assets
@stop 


@section('content')


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Assets</li>
  </ol>
</nav>


<div class="row mb-3">
    <div class="col-sm col-lg">
        <a href="{{ URL::to('cms/assets/create') }}" class="btn btn-primary float-right">ADD NEW</a>
    </div>
</div>

<div class="row">
    <div class="col-sm col-lg">

        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Type</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">Path</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($assets as $asset)
                <tr>
                    <td>{{ $asset->name }}</td>
                    <td>{{ $asset->type }}</td>
                    <td>{{ $asset->category }}</td>
                    <td>{{ $asset->url }}</td>
                    <td class="text-center">
                        <a href="{{ URL::to('cms/assets/delete/'.$asset->id) }}" class="btn btn-xm btn-danger">delete</a>
                        <a href="{{ URL::to('cms/assets/edit/'.$asset->id) }}" class="btn btn-xm btn-info">edit</a>
                    </td>
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
