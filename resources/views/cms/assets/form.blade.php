@extends('layouts.cms')

@section('title')
Add Assets
@stop


@section('content')
<style>
    .input-group>span {
        width: 120px;
    }

    .input-group>span>span {
        width: 120px;
    }
</style>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/cms/assets') }}">Assets</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Assets</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <a href="{{ url('/cms/assets') }}" class="btn btn-info float-right">RETURN</a>
        </div>
        <div class="col-md-6">
            <form action="{{ route('cms.assets.store') . ( $asset->id ? '/' . $asset->id : '') }}" method="post" enctype="multipart/form-data">
                @csrf
                @isset($asset->id)
                {{ method_field('PUT')}}
                @endisset
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-prepend">
                            <span class="input-group-text">Name</span>
                        </span>
                        <input type="text" class="form-control" name="name" placeholder="Name" aria-label="Name"
                            value="{{ old('name', $asset->name) }}">

                    </div>
                </div>
                <div class="form-group">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-prepend">
                            <span class="input-group-text">Type</span>
                        </span>
                        <input type="text" class="form-control" name="type" placeholder="Type" aria-label="Type"
                            value="{{ old('type', $asset->type) }}">
                    </div>
                </div>
                <div class="form-group">
                    @error('type')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-prepend">
                            <span class="input-group-text">Category</span>
                        </span>
                        <input type="text" class="form-control" name="category" placeholder="Category"
                            aria-label="Category" value="{{ old('category', $asset->category) }}">
                    </div>
                </div>
                <div class="form-group">
                    @error('category')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-prepend">
                            <span class="input-group-text">Upload</span>
                        </span>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    @error('url')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-block">ADD NEW ASSET</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );

    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@stop
