@extends('layouts.cms')

@section('title')
Edit Asset
@stop 


@section('content')


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/cms/assets') }}">Assets</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Asset</li>
  </ol>
</nav>


<div class="row mb-3">
    <div class="col-sm col-lg">
        <a href="{{ url('/cms/assets') }}" class="btn btn-info float-right">RETURN</a>
    </div>
</div>

<div class="row">
    <div class="col-sm-8 col-lg-8">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Name</span>
            </div>
            <input type="text" class="form-control" placeholder="Asset Name" aria-label="Name" aria-describedby="basic-addon1" value="{{ $data->name }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4 col-lg-4">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Type</span>
            </div>
            <input type="text" class="form-control" placeholder="Type" aria-label="Type" aria-describedby="basic-addon1" value="{{ $data->type }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-8 col-lg-8">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Caterogy</span>
            </div>
            <input type="text" class="form-control" placeholder="Category" aria-label="Category" aria-describedby="basic-addon1" value="{{ $data->category }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-8 col-lg-8">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-sm-8 col-lg-8">
        <button class="btn btn-success btn-block">UPDATE CHANGES</button>
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
