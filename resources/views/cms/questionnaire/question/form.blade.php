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
                    <li class="breadcrumb-item"><a href="{{ route('cms.questions.index')}}">Questions</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <a href="{{ route('cms.questions.index', 'questionnaire_id='.$questionnaire_id)}}" class="btn btn-info float-right">RETURN</a>
        </div>
        <div class="col-md-6">
            <form action="{{ route('cms.questions.store') . ( $question->id ? '/' . $question->id : '') }}" method="post">
                @csrf
                @isset($question->id)
                {{ method_field('PUT') }}
                @endisset
                @php
                    $model = $question;
                @endphp
                <input type="hidden" name="questionnaire_id" value="{{$questionnaire_id}}">
                @include('cms.include.input-text', ['key' => 'question', 'label' => 'Question'])
                @include('cms.include.input-text', ['key' => 'answer', 'label' => 'Answer'])

                @for ($i = 0; $i<6;$i++)
                    <?php $value = isset($question->choices[$i]) ? $question->choices[$i] : "" ; ?>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text">{{chr(65+$i)}}</span>
                            </span>
                            <input type="text" class="form-control" name="choices[{{$i}}]" placeholder="" aria-label=""
                                value="{{$value}}">
                        </div>
                    </div>
                @endfor
                <div class="form-group">
                    <button class="btn btn-success btn-block">SAVE QUESTION</button>
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
