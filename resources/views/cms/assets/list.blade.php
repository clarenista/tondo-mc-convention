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
                    <th class="text-center">Type</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">Path</th>
                    <th class="text-center">By</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assets as $asset)
                <tr>
                    <td>{{ $asset->name }}</td>
                    <td>{{ $asset->type }}</td>
                    <td>{{ $asset->category }}</td>
                    <td><a href="{{$asset->url }}">{{ basename($asset->url)}}</a></td>
                    <td>{{ $asset->user_id }}</td>
                    <td>
                        <form id="delete" action="{{ route('cms.assets.destroy', $asset->id) }}" method="POST">
                            @csrf
                            {{ method_field('DELETE')}}
                            <div class="btn-group">
                                <button class="btn btn-danger" type="submit">delete</button>
                                <a href="{{ route('cms.assets.edit', $asset->id) }}" class="btn btn-info">edit</a>
                            </div>
                        </form>
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
    $("form#delete").submit(function() {
        return confirm('Are you sure you want to delete?');
    });
</script>

@stop
