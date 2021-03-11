@extends('layouts.cms')

@section('title')
Add Booth
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
                    <li class="breadcrumb-item"><a href="{{ url('/cms/booths') }}">Booth</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Booth</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <a href="{{ url('/cms/booths') }}" class="btn btn-info float-right">RETURN</a>
        </div>
        <div class="col-md-6">
            <form action="{{ route('cms.booths.store') . ( $booths->id ? '/' . $booths->id : '') }}" method="post">
                @csrf
                @isset($booths->id)
                {{ method_field('PUT') }}
                @endisset
                <input type="hidden" name="user_id" value="{{ Auth::id() }}"> <!-- added hidden to get user_id -->
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-prepend">
                            <span class="input-group-text">Name</span>
                        </span>
                        <input type="text" class="form-control" name="name" placeholder="Name" aria-label="Name"
                            value="{{ old('name', $booths->name) }}">
                    </div>
                </div>
                <div class="form-group">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
               
                <div class="form-group">
                    <button class="btn btn-success btn-block">ADD NEW BOOTH</button>
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
