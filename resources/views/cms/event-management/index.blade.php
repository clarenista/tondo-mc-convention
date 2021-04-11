@extends('layouts.cms')

@section('title')
Event Management
@stop

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Event Management</li>
    </ol>
</nav>

<div class="row">
    <div class="col-sm col-lg">
        <h3>PSP EVENT</h3>
        <form action="{{ route('cms.event.update') }}" method="post">
            @csrf
            {{ method_field('PUT') }}
            @php
                $model = $event;
            @endphp
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-prepend">
                    <span class="input-group-text">Start At</span>
                </span>
                <input type="datetime-local" name="start_at"
                    class="form-control"
                    value="{{ old('start_at', Carbon\Carbon::parse($event->start_at)->format('Y-m-d\TH:i')) }}">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-prepend">
                    <span class="input-group-text">End At</span>
                </span>
                <input type="datetime-local" name="end_at"
                    class="form-control"
                    value="{{ old('end_at', Carbon\Carbon::parse($event->end_at)->format('Y-m-d\TH:i')) }}">
            </div>
        </div>
            @include('cms.include.input-text', ['key' => 'title', 'label' => 'Title'])
            @include('cms.include.input-text', ['key' => 'description', 'label' => 'description'])
            <div class="form-group">
                <button class="btn btn-info btn-block">&#10004;UPDATE EVENT</button>
            </div>
        </form>
    </div>
    <div class="col-sm col-lg">
        <h3>Zoom EVENT</h3>
        <form action="{{ route('cms.program.update') }}" method="post">
            @csrf
            {{ method_field('PUT') }}
            @php
                $model = $program;
            @endphp
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-prepend">
                    <span class="input-group-text">Start At</span>
                </span>
                <input type="datetime-local" name="start_at"
                    class="form-control"
                    value="{{ old('start_at', Carbon\Carbon::parse($program->start_at)->format('Y-m-d\TH:i')) }}">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-prepend">
                    <span class="input-group-text">End At</span>
                </span>
                <input type="datetime-local" name="end_at"
                    class="form-control"
                    value="{{ old('end_at', Carbon\Carbon::parse($program->end_at)->format('Y-m-d\TH:i')) }}">
            </div>
        </div>
            @include('cms.include.input-text', ['key' => 'title', 'label' => 'Title'])
            @include('cms.include.input-text', ['key' => 'description', 'label' => 'description'])
            @include('cms.include.input-text', ['key' => 'video_url', 'label' => 'Zoom Link'])
            @include('cms.include.input-text', ['key' => 'unique_id', 'label' => 'Zoom ID'])
            @include('cms.include.input-text', ['key' => 'unique_code', 'label' => 'Zoom Pass Code'])
            <div class="form-group">
                <button class="btn btn-info btn-block">&#10004;UPDATE PROGRAM</button>
            </div>
        </form>
    </div>
</div>

@stop


@section('js')

<script>
</script>

@stop
