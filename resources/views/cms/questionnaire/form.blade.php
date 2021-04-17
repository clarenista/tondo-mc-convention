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
                    <li class="breadcrumb-item"><a href="{{ route('cms.questionnaires.index')}}">Questionnaires</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <a href="{{ route('cms.questionnaires.index')}}" class="btn btn-info float-right">RETURN</a>
        </div>
        <div class="col-md-6">
            <form action="{{ route('cms.questionnaires.store') . ( $questionnaire->id ? '/' . $questionnaire->id : '') }}" method="post">
                @csrf
                @isset($questionnaire->id)
                {{ method_field('PUT') }}
                @endisset
                @php
                    $model = $questionnaire;
                @endphp
                <input type="hidden" name="questionnaire_id" value="1">
                @include('cms.include.input-text', ['key' => 'instruction', 'label' => 'Instruction'])
                @include('cms.include.input-text', ['key' => 'ending_message', 'label' => 'Ending Message'])
                @include('cms.include.input-text', ['key' => 'name', 'label' => 'Name'])
                @include('cms.include.input-text', ['key' => 'description', 'label' => 'Description'])
                <input type="hidden" name="category" value="quiz">
                <div class="form-group">
                    <button class="btn btn-success btn-block">SAVE QUESTIONNAIRE</button>
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
</script>
@stop
