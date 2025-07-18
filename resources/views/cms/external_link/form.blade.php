@extends('layouts.cms')

@section('title')
Add External Link
@stop


@section('content')
<style>
    .input-group>span {
        width: 150px;
    }

    .input-group>span>span {
        width: 150px;
    }
</style>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <!-- <li class="breadcrumb-item"><a href="{{ route('cms.sponsor.links.index') }}">External Link</a></li> -->
                    <li class="breadcrumb-item active" aria-current="page">Add External Link</li>
                </ol>
            </nav>
        </div>
        <!-- <div class="col-md-12">
            <a href="{{ route('cms.sponsor.links.index') }}" class="btn btn-info float-right">RETURN</a>
        </div> -->
        <div class="col-md-6">
            <form action="{{ route('cms.sponsor.links.store') . ( $asset->id ? '/' . $asset->id : '') }}" method="post">
                @csrf
                @isset($asset->id)
                {{ method_field('PUT') }}
                @endisset

                <input type="hidden" name="user_id" value="{{ Auth::id() }}"> <!-- added hidden to get user_id -->
                <input type="hidden" name="type" value="external_link">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-prepend">
                            <span class="input-group-text">Hotspot Name</span>
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
                            <span class="input-group-text">External Link</span>
                        </span>
                        <input type="text" class="form-control" name="url" placeholder="Url" aria-label="Url"
                            value="{{ old('url', $asset->url) }}">
                    </div>
                </div>
                <div class="form-group">
                    @error('url')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button class="btn btn-info btn-block">&#10004; {{isset($asset->id) ? 'UPDATE EXTERNAL LINK' : 'ADD EXTERNAL LINK'}}</button>
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
