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
            <form action="{{ route('cms.booths.store') . ( $booth->id ? '/' . $booth->id : '') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @isset($booth->id)
                {{ method_field('PUT') }}
                @endisset
                <input type="hidden" name="user_id" value="{{ Auth::id() }}"> <!-- added hidden to get user_id -->
                <?php $model = $booth; ?>
                @include('cms.include.input-text', ['key' => 'name', 'label' => 'Name'])
                @include('cms.include.input-text', ['key' => 'caption', 'label' => 'Caption'])
                @include('cms.include.input-text', ['key' => 'url', 'label' => 'Url'])
                @include('cms.include.input-text', ['key' => 'x', 'label' => 'X Position'])
                @include('cms.include.input-text', ['key' => 'y', 'label' => 'Y Position'])
                @include('cms.include.input-file', ['key' => 'background', 'label' => 'Background'])
                @include('cms.include.input-file', ['key' => 'booth', 'label' => 'Booth'])
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
