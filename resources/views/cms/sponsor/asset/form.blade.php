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
                    <li class="breadcrumb-item"><a href="{{ route('cms.sponsor.assets.index', ['hotspot_id'=> \request()->hotspot_id])}}">{{ $hotspot->name }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add {{$hotspot->name}}</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <a href="{{ route('cms.sponsor.assets.index', ['hotspot_id'=> \request()->hotspot_id])}}" class="btn btn-info float-right">RETURN</a>
        </div>
        <div class="col-md-6">
            <form action="{{ route('cms.sponsor.assets.store') . ( $asset->id ? '/' . $asset->id : '') }}?hotspot_id={{\request()->hotspot_id}}" method="post"
                enctype="multipart/form-data">
                @csrf
                @isset($asset->id)
                {{ method_field('PUT') }}
                @endisset
                <input type="hidden" name="user_id" value="{{ Auth::id() }}"> <!-- added hidden to get user_id -->
                <input type="hidden" name="type" value=" {{$hotspot->name}}"> <!-- added hidden to get user_id -->
                <input type="hidden" name="category" value=" {{$hotspot->name}}"> <!-- added hidden to get user_id -->
                <?php $model = $asset; ?>
                @include('cms.include.input-text', ['key' => 'name', 'label' => 'Name'])
                @include('cms.include.input-file', ['key' => 'file', 'label' => 'File'])
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
    });
    $("input[type=file]").each(function () {
        $(this).on('change', function(){
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });
</script>
@stop
