@extends('layouts.cms')

@section('title')
    Assets
@stop

@section('content')
    <div class="d-flex">
        <div class="flex-fill">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Wheel of Fortune</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-sm col-lg">
            <form action="{{ route('cms.sponsor.wheels.store') . ($wheel->id ? '/' . $wheel->id : '') }}?hotspot_id={{ \request()->hotspot_id }}" method="post">
                @csrf
                @if(isset($wheel->id))
                {{ method_field('PUT') }}
                @endif
                @for ($i = 0; $i <= 10; $i++)
                    <div class="form-group">
                        <div class="input-group">
                            @php
                                $segment = isset($wheel->segments[$i]) ? $wheel->segments[$i] : ['fillStyle' => '', 'text' => '', 'size' => ''];
                            @endphp
                            <span class="input-group-prepend">
                                <input type="text" class="form-control" name="fillStyle[]" placeholder="Color (Hexadecimal)" aria-label="Color (Hexadecimal)" value="{{ $segment['fillStyle'] }}">
                            </span>
                            <input type="text" class="form-control" name="text[]" placeholder="Text" aria-label="Text" value="{{ $segment['text'] }}">
                            <input type="text" class="form-control" name="size[]" placeholder="% Size" aria-label="Size %" value="{{ $segment['size'] }}">
                        </div>
                    </div>
                @endfor
                <div class="form-group">
                    <button class="btn btn-success btn-block">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
@stop
