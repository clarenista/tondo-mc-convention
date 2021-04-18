@extends('layouts.cms')

@section('title')
Assets
@stop
<style>
    .input-group>span {
        width: 150px;
    }

    .input-group>span>span {
        width: 150px;
    }
</style>

@section('content')

@role('sponsor')
<div>
    <form action="{{ route('cms.sponsor.questionnaires.quick.update', request()->questionnaire_id) }}" method="post">
        @csrf
        @php
            $model = $questionnaire;
        @endphp
        @include('cms.include.input-text', ['key' => 'instruction', 'label' => 'Instruction'])
        @include('cms.include.input-text', ['key' => 'ending_message', 'label' => 'Ending Message'])
        <div class="form-group">
            <button class="btn btn-success btn-block">UPDATE </button>
        </div>
    </form>
</div>
@endrole
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @role('admin')
        <li class="breadcrumb-item"><a href="{{ route('cms.questionnaires.index')}}">Questionnaires</a></li>
        @endrole
        <li class="breadcrumb-item active" aria-current="page">Questions</li>
    </ol>
</nav>

<div class="row mb-3">
    <div class="col-sm col-lg">
        @role('admin')
        <a href="{{ route('cms.questionnaires.index')}}" class="btn btn-info float-right">RETURN</a>
        @endrole
        <a href="{{ route('cms.questions.create', 'questionnaire_id='. request()->questionnaire_id) }}"
            class="btn btn-primary float-right">ADD QUESTION</a>
    </div>
</div>

<div class="row">
    <div class="col-sm col-lg">

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif

        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Question</th>
                    <th class="text-center">Answer</th>
                    <th class="text-center">Choices</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($questions as $question)
                <tr>
                    <td>{{ $question->question }}</td>
                    <td>{{ $question->answer }}</td>
                    <td>{{ join(", ", $question->choices) }}</td>
                    <td>
                        <form id="delete"
                            action="{{ route('cms.questions.destroy', $question->id) }}"
                            method="POST">
                            @csrf
                            {{ method_field('DELETE')}}
                            <div class="btn-group">
                                <a href="{{ route('cms.questions.edit', $question->id) }}"
                                    class="btn btn-info">edit</a>
                                    <button class="btn btn-danger" type="submit">delete</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop


@section('js')

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    $("form#delete").submit(function() {
        return confirm('Are you sure you want to delete?');
    });
</script>

@stop
